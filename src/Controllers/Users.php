<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Controller;
use Manix\Brat\Utility\Admin\Models\AdminPatchedUserGateway;
use Manix\Brat\Utility\Admin\Models\UserAdminGateway;
use Manix\Brat\Utility\Admin\Views\UsersView;
use Manix\Brat\Utility\Users\Models\UserEmailGateway;

class Users extends Controller implements AdminFeature {

  public $page = UsersView::class;
  
  public function id() {
    return 2;
  }

  public function get() {
    $gate = new AdminPatchedUserGateway();
    $gate->join('admin', new UserAdminGateway());
    $gate->join('emails', new UserEmailGateway());
    
    return [
        'users' => $gate->find()
    ];
  }

  public function description() {
    
  }

  public function icon() {
    
  }

  public function image() {
    
  }

  public function name() {
    
  }

  public function accessControl(\Manix\Brat\Utility\Users\Models\User $user): bool {
    
  }

  public function hidden(): bool {
    
  }

}
