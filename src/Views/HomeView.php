<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Utility\Admin\Controllers\Users;
use function route;

class HomeView extends AdminLayout {

  public function content() {
    echo "<pre>" . print_r($this->data, true) . "</pre>";
  }

}
