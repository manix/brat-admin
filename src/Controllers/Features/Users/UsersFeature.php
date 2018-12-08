<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Users;

use Manix\Brat\Utility\Admin\Controllers\Feature;

trait UsersFeature {

  use Feature;

  public function description() {
    return 'Manage users';
  }

  public function icon() {
    return 'user';
  }

  public function name() {
    return 'Users';
  }

  public function id() {
    return 1.1;
  }

}
