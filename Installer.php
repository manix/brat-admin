<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Utility\PluginInstaller;

class Installer extends PluginInstaller {

  public function getDir() {
    return new Directory(__DIR__ . '/src/instance');
  }

  public function install() {
    $this->getDir()->copy($this->getProjectRoot());
  }

  public function uninstall() {
    $local = __DIR__ . '/src/instance';
    $project = $this->getProjectRoot();

    foreach ($this->getDir()->files() as $file) {
      $installed = str_replace($local, $project, $file);

      if (is_file($installed)) {
        unlink($installed);
      }
    }
  }

}

return new Installer();
