<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features;

use Manix\Brat\Utility\Admin\Controllers\Feature;
use Manix\Brat\Utility\Admin\Models\AdminUser;
use Manix\Brat\Utility\Admin\Views\AdminIndexView;

class Home extends Feature {

    public $page = AdminIndexView::class;

    public function getDescription(): string {
        
    }

    public function getDisplayName(): string {
        
    }

    public function getId(): int {
        
    }

    public function hidden(): bool {
        return true;
    }

    public function accessControl(AdminUser $user): bool {
        return isset($user);
    }

    public function get() {
        return [];
    }
}
