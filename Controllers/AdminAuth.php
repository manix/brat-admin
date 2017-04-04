<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Utility\Admin\Models\AdminUserGateway;
use Manix\Brat\Utility\Admin\Views\AdminLoginView;
use const PROJECT_PATH;

class AdminAuth extends AdminController {

    public $page = AdminLoginView::class;

    public function get() {
        if (empty($_SESSION[MANIX]['admin'])) {
            return [];
        } else {
            return $_SESSION[MANIX]['admin'];
        }
    }

    public function post() {

        /**
         * TODO make directory dynamic via config
         */
        $gate = new AdminUserGateway(new Directory(PROJECT_PATH . '/files/data'));
        $user = $gate->find($_POST['username'] ?? null)->first();

        $this->cacheT8('manix/util/admin');

        if (!$user) {
            return [
                'error' => $this->t8('errorUserNotFound')
            ];
        } else {
            if ($user->password !== ($_POST['password'] ?? null)) {
                return [
                    'error' => $this->t8('errorWrongPassword')
                ];
            }
        }

        $_SESSION[MANIX]['admin']['user'] = [
            'name' => $user->name,
            'display_name' => $user->display_name,
            'email' => $user->email,
            'privileges' => $user->privileges
        ];

        header('Location: ' . $_GET['b'] ?? (SITE_URL . '/' . config('manix/admin')['route']));
    }

    public function delete() {
        unset($_SESSION[MANIX]['admin']);
        exit;
    }
}
