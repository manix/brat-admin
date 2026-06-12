<?php

namespace Manix\Brat\Utility\Admin\Middleware;

use Exception;
use Manix\Brat\Components\Controller;
use Manix\Brat\Components\Middleware;
use Manix\Brat\Components\Program;
use Manix\Brat\Utility\Users\Models\Auth;
use Project\Traits\Admin\AdminGatewayFactory;

class AccessControl implements Middleware {

  use AdminGatewayFactory;

  public function execute(Controller $controller, $method, Program $program) {
    $auth = Auth::user();

    if (!isset($auth->groups)) {
      $gate = $this->instantiate($this->usersGroupsGateway())->timestamps(false);

      $auth->groups = $gate->find($auth->id)->map(function ($model) {
        return $model->group_id;
      });

      Auth::register($auth);
    }
    
    $permissions = cache('acl/perm/' . $controller->permissions_id(), function () use ($controller) {
      $permissions = [];
      foreach ($this->instantiate($this->permissionsGateway())->find($controller->permissions_id()) as $record) {
        $permissions[$record->group_id] = $record->readonly;
      }
      return $permissions;
    }, 86400);
    $controller->permissions($permissions);
    
    if ($controller->accessControl($auth, $method !== 'get')) {
      return;
    }

    throw new Exception('Forbidden', 403);
  }

}
