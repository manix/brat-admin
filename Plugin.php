<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Components\Plugins\AbstractPlugin;

class Plugin extends AbstractPlugin {

  public function routes(): array {
    return [
        'admin' => 'Manix\\Brat\\Utility\\Admin\\Controllers\\'
    ];
  }

  public function instance(): Directory {
    return new Directory(__DIR__ . '/src/instance');
  }

}

return new Plugin();
