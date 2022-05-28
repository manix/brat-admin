<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Middleware\AccessControl;
use Manix\Brat\Utility\Admin\Middleware\AccessLog;
use Manix\Brat\Utility\Users\Models\User;
use function config;

trait Feature {

  protected $permissions = [];

  public function middleware() {
    return ['auth', AccessControl::class, AccessLog::class];
  }

  public function id() {
    return static::class;
  }

  /**
   * Determine whether this feature should be hidden from lists.
   * @return bool
   */
  public function hidden(): bool {
    return false;
  }

  public function icon() {
    return null;
  }

  public function image() {
    return null;
  }

  public function permissions($permissions = null) {
    if ($permissions) {
      $this->permissions = $permissions;
      return $this;
    }

    return $this->permissions;
  }

  public function accessControl(User $user, $write = false) {
    if ((int)$user->id === (int)config('manix/admin')['super']) {
      return true;
    }

    if (empty($user->groups)) {
      return false;
    }

    $supergroup = (int)config('manix/admin')['supergroup'] ?? 0;
    foreach ($this->permissions() as $groupId => $readonly) {
      if ($write && $readonly) {
        continue;
      }

      if (in_array($groupId, $user->groups) || $groupId === $supergroup) {
        return true; 
      }
    }

    return false;
  }

}
