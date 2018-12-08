<?php

namespace Manix\Brat\Utility\Admin\Traits;

use Manix\Brat\Helpers\Factory;
use Manix\Brat\Utility\Admin\Models\AccessLogGateway;
use Manix\Brat\Utility\Admin\Models\GroupsGateway;
use Manix\Brat\Utility\Admin\Models\PermissionsGateway;
use Manix\Brat\Utility\Admin\Models\UsersGroupsGateway;

trait AdminGatewayFactory {

  use Factory;

  public function accessLogGateway() {
    return AccessLogGateway::class;
  }

  public function groupsGateway() {
    return GroupsGateway::class;
  }

  public function permissionsGateway() {
    return PermissionsGateway::class;
  }

  public function usersGroupsGateway() {
    return UsersGroupsGateway::class;
  }

}
