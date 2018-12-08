<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Components\Collection;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Users\Models\User;
use Project\Traits\Admin\AdminGatewayFactory;
use const DEBUG_MODE;
use function cache;
use function config;

class Features {

  use AdminGatewayFactory;

  protected static $features;

  public static function get($id) {
    return self::getAll()->findCallback(function ($feature) use ($id) {
      return $feature->id() == $id;
    });
  }

  /**
   * Get all features.
   * @return AdminFeature[]
   */
  final public static function getAll() {
    if (self::$features === null) {
      self::$features = DEBUG_MODE ? self::constructFeaturesList() : cache('manix/admin/features', function () {
        return self::constructFeaturesList();
      });
    }
    return self::$features;
  }

  public static function getForUser(User $user) {
    return self::getAll()->filter(function ($feature) use ($user) {
      return $feature->accessControl($user);
    });
  }

  public static function getAllAssociative() {
    $list = [];

    foreach (self::getAll() as $feature) {
      $list[(string)$feature->id()] = $feature;
    }

    return $list;
  }

  protected static function constructFeature($class, $list, $permissions) {
    $instance = new $class;
    $instance->permissions($permissions[$instance->id()] ?? []);
    $list->push($instance);
  }

  protected static function constructFeaturesList() {
    $features = new Collection(AdminFeature::class);
    $permissions = [];
    $ctrl = new \Manix\Brat\Utility\Admin\Controllers\Features\Permissions\Index;

    foreach ($ctrl->instantiate($ctrl->permissionsGateway())->find() as $record) {
      if (empty($permissions[$record->feature_id])) {
        $permissions[$record->feature_id] = [];
      }
      $permissions[$record->feature_id][$record->group_id] = $record->readonly;
    }

    foreach (config('manix/admin')['features'] ?? [] as $class) {
      self::constructFeature($class, $features, $permissions);
    }

    foreach (config('plugins') as $class) {
      $plugin = new $class;

      if (method_exists($plugin, 'features')) {
        foreach ($plugin->features() as $feature) {
          self::constructFeature($feature, $features, $permissions);
        }
      }
    }

    return $features;
  }

}
