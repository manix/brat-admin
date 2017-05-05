<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Controller;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Models\UserAdmin;
use Manix\Brat\Utility\Admin\Views\HomeView;
use Manix\Brat\Utility\Users\Models\Auth;

class Home extends Controller implements AdminFeature {

  use Feature {
    accessControl as actrl;
  }

  public $page = HomeView::class;

  public function id() {
    return 1;
  }

  public function hidden(): bool {
    return true;
  }

  public function accessControl(UserAdmin $user): bool {
    return isset($user->user_id);
  }

  public function get() {
    return [
        'features' => $this->getFeatures()->filter(function($feature) {
          return $feature->accessControl(Auth::user()->admin ?? null);
        })
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
