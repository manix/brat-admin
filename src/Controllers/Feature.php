<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Models\AdminUser;

abstract class Feature extends AdminAccess {

    /**
     * Get the URL for this feature.
     * @return string URL
     */
    public static function url(): string {
        return SITE_URL . '/admin?id=' . static::class;
    }

    abstract public function getId(): int;

    abstract public function getDisplayName(): string;

    abstract public function getDescription(): string;

    /**
     * Must return the col index for bootstrap's grid system.
     * @return int
     */
    public function getWidth(): int {
        return 3;
    }

    /**
     * Determine whether this feature should be hidden from lists.
     * @return bool
     */
    public function hidden(): bool {
        return false;
    }

    /**
     * Determine whether $user can access this feature.
     * @param fAdminUser $user
     * @return boolean
     */
    public function accessControl(AdminUser $user): bool {
        if ($user) {
            
        }

        return true;
    }

}
