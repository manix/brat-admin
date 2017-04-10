<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Utility\PluginInstaller;

class Installer extends PluginInstaller {

  public static function getDir() {
    return new Directory(__DIR__ . '/instance');
  }

  public static function getProjectPath() {
    return realpath(__DIR__ . '/../../../');
  }

  public static function install() {
    self::getDir()->copy(self::getProjectPath());
  }

  public static function uninstall() {
    $local = __DIR__ . '/instance';
    $project = self::getProjectPath();

    foreach (self::getDir()->files() as $file) {
      unlink(str_replace($local, $project, $file));
    }
  }

}
