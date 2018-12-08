<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Users;

use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Utility\Admin\Controllers\AdminFeatureCRUDController;
use Project\Traits\Users\UserGatewayFactory;

class Index extends AdminFeatureCRUDController {

  use UsersFeature,
      UserGatewayFactory;

  public function getColumns() {
    return ['id', 'name', 'created', 'updated'];
  }

  public function getEditableFields() {
    return ['name'];
  }

  public function requireQuery() {
    return true;
  }

  protected function constructGateway(): Gateway {
    return $this->getUserGateway();
  }

}
