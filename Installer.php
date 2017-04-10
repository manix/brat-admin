<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Utility\PluginInstaller;

class Installer extends PluginInstaller {

  public static function getDir() {
    return new Directory(__DIR__ . '/instance');
  }

  public static function install() {
    self::getDir()->copy(self::getProjectRoot());
  }

  public static function uninstall() {
    $local = __DIR__ . '/instance';
    $project = self::getProjectRoot();

    foreach (self::getDir()->files() as $file) {
      unlink(str_replace($local, $project, $file));
    }
  }

}
