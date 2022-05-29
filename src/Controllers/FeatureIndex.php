<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Views\HomeView;
use Manix\Brat\Utility\Users\Models\Auth;
use Manix\Brat\Utility\Admin\Models\Features;

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
    	$f = Features::get($feature->id());
    	$feature->permissions($f->permissions());
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
