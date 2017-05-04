<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Utility\Admin\Models\UserAdmin;

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
   * Determine whether $user can access this feature.
   * @param fAdminUser $user
   * @return boolean
   */
  public function accessControl(UserAdmin $user): bool;
}
