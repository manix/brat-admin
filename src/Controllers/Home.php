<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Models\Features;
use Manix\Brat\Utility\Admin\Views\HomeView;
use Manix\Brat\Utility\Users\Models\Auth;

class Home extends AdminController {

  public $page = HomeView::class;

  public function id() {
    return 1.0;
  }

  public function hidden(): bool {
    return true;
  }

  public function get() {
    return [
        'features' => Features::getForUser(Auth::user())
    ];
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

}
