<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\HTTP\HTTPController;

abstract class AdminController extends HTTPController implements AdminFeature {

  use Feature;
}
