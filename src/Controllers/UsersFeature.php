<?php

namespace Manix\Brat\Utility\Admin\Controllers;

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
    return 2;
  }

}
