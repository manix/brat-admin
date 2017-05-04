<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Components\Plugins\AbstractPlugin;
use Manix\Brat\Utility\Admin\Controllers\Cache;
use Manix\Brat\Utility\Admin\Controllers\Home;
use Manix\Brat\Utility\Admin\Controllers\Users;

class Plugin extends AbstractPlugin {

  public function features(): array {
    return [
        Home::class,
        Users::class,
        Cache::class
    ];
  }

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
