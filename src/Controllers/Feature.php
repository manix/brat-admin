<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Exception;
use Manix\Brat\Components\Criteria;
use Manix\Brat\Utility\Admin\Models\UserAdminGateway;
use Manix\Brat\Utility\Users\Models\Auth;
use Manix\Brat\Utility\Users\Models\User;

trait Feature {

  public function __construct() {
    $this->on('before-execute', [$this, 'authorizeAuth']);
  }

  public function authorizeAuth() {
    Auth::required();

    $auth = Auth::user();

    if (!isset($auth->admin)) {
      $gate = new UserAdminGateway();
      $criteria = new Criteria();
      $criteria->equals('user_id', $auth->id);

      $auth->admin = $gate->findBy($criteria);

      Auth::register($auth);
    }

    if (!$this->accessControl($auth)) {
      throw new Exception('Forbidden', 403);
    }
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

  /**
   * Determine whether $user can access this feature.
   * @param fAdminUser $user
   * @return boolean
   */
  public function accessControl(User $user): bool {
    if ($user) {
      return true;
    }
  }

  /**
   * Get all registered features.
   */
  final public function getFeatures() {
    $features = [];

    foreach (config('plugins') as $class) {
      $plugin = new $class;

      foreach ($plugin->features() as $feature) {
        $features[] = new $feature;
      }
    }

    return $features;
  }

}
