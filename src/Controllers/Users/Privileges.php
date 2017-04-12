<?php

namespace Manix\Brat\Utility\Admin\Controllers\Users;

use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Controllers\Users;
use Manix\Brat\Utility\Admin\Models\AdminPatchedUserGateway;
use Manix\Brat\Utility\Admin\Models\UserAdminGateway;
use Manix\Brat\Utility\Admin\Views\UsersPrivilegesView;

class Privileges extends Users implements AdminFeature {

  public $page = UsersPrivilegesView::class;

  public function get() {
    $gate = new AdminPatchedUserGateway();
    $gate->join('admin', new UserAdminGateway());
    
    return [
        'user' => $gate->find($_GET['id'] ?? null)->first()
    ];
  }

}
