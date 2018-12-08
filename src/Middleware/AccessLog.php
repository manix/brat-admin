<?php

namespace Manix\Brat\Utility\Admin\Middleware;

use Manix\Brat\Components\Controller;
use Manix\Brat\Components\Middleware;
use Manix\Brat\Components\Model;
use Manix\Brat\Components\Program;
use Manix\Brat\Helpers\Time;
use Manix\Brat\Utility\Users\Models\Auth;
use Project\Traits\Admin\AdminGatewayFactory;

class AccessLog implements Middleware {

  use AdminGatewayFactory;

  public function execute(Controller $controller, $method, Program $program) {
    if ($method !== 'get') {
      $gate = $this->instantiate($this->accessLogGateway());
      $gate->persist(new Model([
          'user_id' => Auth::id(),
          'created' => new Time(),
          'feature_id' => $controller->id(),
          'payload' => json_encode([
              $_GET,
              $_POST,
              $_FILES,
              array_intersect_key($_SERVER, [
                  'HTTP_USER_AGENT' => 1,
                  'CONTENT_TYPE' => 1,
                  'CONTENT_LENGTH' => 1,
                  'REMOTE_ADDR' => 1,
                  'SERVER_PROTOCOL' => 1,
                  'REQUEST_METHOD' => 1,
              ])
          ])
      ]));
    }
  }

}
