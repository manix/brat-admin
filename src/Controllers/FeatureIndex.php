<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Views\HomeView;
use Manix\Brat\Utility\Users\Models\Auth;

trait FeatureIndex {

  abstract public function features();

  public function featureLitView() {
    return HomeView::class;
  }

  public function get() {
    $this->page = $this->featureLitView();

    $user = Auth::user();
    $features = [];
    
    foreach ($this->features() as $feature) {
    	if ($feature->accessControl($user)) {
    	    $features[] = $feature;
    	}
    }

    return [
        'features' => $features,
        'ctrl' => $this
    ];
  }

}
