<?php

namespace Manix\Brat\Utility\Admin\Controllers;

class AdminAccess extends AdminController {

    /**
     * @var bool Indicates whether the request must pass admin authentication or not.
     */
    protected $authRequired = true;

    public function __construct() {
        
        if ($this->authRequired && empty($_SESSION[MANIX]['admin'])) {
            header('Location: ' . SITE_URL . '/admin/adminAuth?b=' . urlencode(url()));
            exit();
        }

        parent::__construct();
    }

}
