<?php

namespace Manix\Brat\Utility\Admin;

use Manix\Brat\Components\Filesystem\Directory;
use Manix\Brat\Components\Plugin;
use Manix\Brat\Utility\Admin\Controllers\Features\Groups\Index as Index2;
use Manix\Brat\Utility\Admin\Controllers\Features\Permissions\Index as Index3;
use Manix\Brat\Utility\Admin\Controllers\Features\Users\Index;
use Manix\Brat\Utility\Admin\Controllers\Home;
use Manix\Brat\Utility\Scripts\RunSQL;

class Installer extends Plugin {

  public function features(): array {
    return [
        Home::class,
        Index::class,
        Index2::class,
        Index3::class
    ];
  }

  public function routes(): array {
    return [
        'admin' => 'Manix\\Brat\\Utility\\Admin\\Controllers\\'
    ];
  }

  public function instance(): Directory {
    return new Directory(__DIR__ . '/instance');
  }

  public function onafterInstall() {
    (new RunSQL([
        __DIR__ . '/database-schemas'
    ]))->exec();
  }

}
