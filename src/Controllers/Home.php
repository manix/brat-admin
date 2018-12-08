<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Models\Features;
use Manix\Brat\Utility\Users\Models\Auth;

class Home extends AdminController {

  use FeatureIndex;

  public function id() {
    return 1.0;
  }

  public function hidden(): bool {
    return true;
  }

  public function description() {
    return null;
  }

  public function icon() {
    return 'home';
  }

  public function name() {
    return 'Home';
  }

  public function features() {
    return Features::getForUser(Auth::user());
  }

}
