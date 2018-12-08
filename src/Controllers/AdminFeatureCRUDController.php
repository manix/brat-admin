<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Views\AdminCRUDView;
use Manix\Brat\Utility\CRUD\CRUDEndpoint;

abstract class AdminFeatureCRUDController extends AdminController {

  use CRUDEndpoint;

  public function getCRUDView() {
    return AdminCRUDView::class;
  }

}
