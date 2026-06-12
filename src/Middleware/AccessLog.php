<?php

namespace Manix\Brat\Utility\Admin\Middleware;

use Manix\Brat\Components\Controller;
use Manix\Brat\Components\Middleware;
use Manix\Brat\Components\Model;
use Manix\Brat\Components\Program;
use Manix\Brat\Helpers\Time;
use Manix\Brat\Utility\Users\Models\Auth;
use Project\Traits\Admin\AdminGatewayFactory;
use Manix\Brat\Utility\Events\Controllers\AfterExecute;

class AccessLog implements Middleware {

  use AdminGatewayFactory;

  public function execute(Controller $controller, $method, Program $program) {
    
    if ($method !== 'get') {

      $record = new Model($this->collect_data($controller));

      $gate = $this->instantiate($this->accessLogGateway());
      // $gate->persist($record);
      
      $controller->on(AfterExecute::class, function ($event) use ($gate, $record) {
        $controller = $event->getController();
        $data = $event->getData();

        if (($data['success'] ?? false) === true && isset($_GET[$controller->createKey ?? 'new']) && !empty($data['model'])) {
          // no need to check if controller has resource_id method, above checks are pretty safe
          $record->resource_id = $controller->resource_id((array)$data['model']);
        }

        $record->result = json_encode($this->clean_result($data));

        $gate->persist($record);
      });
    }
  }

  public function clean_result(&$data) {
    unset($data['goto']);
    unset($data['ctrl']);
    // keep model as there might be a difference between input and saved model data
    // unset($data['model']);
    if (isset($data['form'])) {
      $data['form'] = [
        'errors' => $data['form']->errors
      ];
    }

    return $data;
  }

  public function collect_data($controller) {

    $user_id = Auth::id();
    $created = (new Time)->format('Y-m-d H:i:s.u');

    $query = $_GET;
    $body = $_POST;

    $request_method = ($_SERVER['REQUEST_METHOD'] ?? '') . '/' . ($body['manix-method'] ?? '');

    unset($query['route']);
    unset($body['manix-save']);
    unset($body['manix-create']);
    unset($body['manix-csrf']);
    unset($body['manix-method']);

    $data = [
      'user_id' => $user_id,
      'created' => $created,
      'feature_id' => $controller->id(),
      'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
      'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? '',
      'server_protocol' => $_SERVER['SERVER_PROTOCOL'] ?? '',
      'request_method' => $request_method,
      'route' => $_GET['route'] ?? '',
      'query' => json_encode($query),
      'body' => json_encode($body),
      'files' => json_encode($_FILES),
      'resource_id' => method_exists($controller, 'resource_id') ? $controller->resource_id($_REQUEST) : '',
      'result' => ''
    ];

    return $data;

  }

}
