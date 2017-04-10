<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Controller;
use function config;

class AdminController extends Controller {

    public function __construct() {
        $this->data['project'] = config('project');
        $this->data['adminuser'] = $_SESSION[MANIX]['admin']['user'] ?? null;
    }

}
