<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Users\Models\User;

interface AdminFeature {

  public function id();

  public function name();

  public function description();

  public function icon();

  public function image();

  /**
   * Determine whether this feature should be hidden from lists.
   * @return bool
   */
  public function hidden(): bool;

  /**
   * Get or set the permissions for this feature.
   * @param type $permissions
   */
  public function permissions($permissions = null);

  public function accessControl(User $user, $write = false);
}
