<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Controller;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Views\HomeView;
use Manix\Brat\Utility\Users\Models\User;

class Home extends Controller implements AdminFeature {

  use Feature;

  public $page = HomeView::class;

  public function id() {
    return 1;
  }

  public function hidden(): bool {
    return true;
  }

  public function accessControl(User $user): bool {
    return isset($user);
  }

  public function get() {
    return [
        'features' => $this->getFeatures()
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

}
