<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Views\HomeView;

trait FeatureIndex {

  abstract public function features();

  public function featureLitView() {
    return HomeView::class;
  }

  public function get() {
    $this->page = $this->featureLitView();

    return [
        'features' => $this->features(),
        'ctrl' => $this
    ];
  }

}
