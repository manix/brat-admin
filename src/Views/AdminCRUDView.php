<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Utility\CRUD\CRUDView;

class AdminCRUDView extends CRUDView {

  use AdminLayoutTrait;

  public function renderHeader() {
    $feature = $this->data[2] ?? null;

    if ($feature) {
      echo new FeatureView([$feature, [
              'hideImage' => true,
              'hideDesc' => true,
              'notClickable' => true
          ]], $this->html);
    }
  }

}
