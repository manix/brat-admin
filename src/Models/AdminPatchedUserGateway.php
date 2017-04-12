<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Utility\Users\Models\UserGateway;

class AdminPatchedUserGateway extends UserGateway {
  
  public function __construct() {
    parent::__construct();
    
    $this->rel['admin'] = [UserAdminGateway::class, 'id', 'user_id'];
  }
}
