<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Models\Features;
use Manix\Brat\Utility\Users\Models\Auth;

class Home extends AdminController {

  use FeatureIndex;

  public function permissions_id() {
    return "home";
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
    return [
    	// TODO define features
    ];
  }

}
