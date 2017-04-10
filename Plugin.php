<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Components\Plugins\AbstractPlugin;

class Plugin extends AbstractPlugin {

  public function routes() {
    return [
        'admin' => 'Manix\\Brat\\Utility\\Admin\\Controllers\\'
    ];
  }

  public function instance() {
    return new Directory(__DIR__ . '/src/instance');
  }

}

return new Plugin();
