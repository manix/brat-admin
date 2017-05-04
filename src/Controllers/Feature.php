<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Exception;
use Manix\Brat\Components\Collection;
use Manix\Brat\Components\Criteria;
use Manix\Brat\Utility\Admin\Models\UserAdmin;
use Manix\Brat\Utility\Admin\Models\UserAdminGateway;
use Manix\Brat\Utility\Users\Models\Auth;
use function config;

trait Feature {

  protected static $features;

  public function before($method) {
    Auth::required();

    $auth = Auth::user();

    if (!isset($auth->admin)) {
      $gate = new UserAdminGateway();
      $criteria = new Criteria();
      $criteria->equals('user_id', $auth->id);

      $auth->admin = $gate->findBy($criteria)->first();

      if (!$auth->admin) {
        $auth->admin = new UserAdmin();
      }

      Auth::register($auth);
    }

    if (!$this->accessControl($auth->admin)) {
      throw new Exception('Forbidden', 403);
    }
    
    return $method;
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

  /**
   * Determine whether $user can access this feature.
   * @param fAdminUser $user
   * @return boolean
   */
  public function accessControl(UserAdmin $user): bool {
    return $user->hasPrivilege($this->id()) || (int)($user->user_id ?? 0) === (int)config('manix/admin')['super'];
  }

  /**
   * Get all registered features.
   */
  final public function getFeatures() {
    if (self::$features === null) {

      $features = new Collection(AdminFeature::class);

      foreach (config('plugins') as $class) {
        $plugin = new $class;

        foreach ($plugin->features() as $feature) {
          $features->push(new $feature);
        }
      }

      self::$features = $features;
    }

    return self::$features;
  }

}
