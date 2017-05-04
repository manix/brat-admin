<?php

namespace Manix\Brat\Utility\Admin\Views\Cache;

use Manix\Brat\Utility\Admin\Controllers\Cache;
use Manix\Brat\Utility\Admin\Views\AdminLayout;
use function route;

abstract class CacheLayout extends AdminLayout {

  public function content() {
    ?>
    <div class="d-flex h3 mb-0">
      <a class="bg-faded text-center py-3 w-50" href="<?= route(Cache::class) ?>">
        <i class="fa fa-file"></i>
      </a>
      <a class="bg-success text-white text-center py-3 w-25" href="<?= route(Cache\Write::class) ?>">
        <i class="fa fa-pencil"></i>
      </a>
      <a class="bg-danger text-white text-center py-3 w-25" href="<?= route(Cache::class) ?>">
        <i class="fa fa-trash"></i>
      </a>
    </div>
    <?php
    echo $this->podka();
  }

  abstract public function podka();
}
