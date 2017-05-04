<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Utility\Admin\Controllers\Users;
use function route;

abstract class UsersLayout extends AdminLayout {

  public function content() {
    ?>
    <div class="d-flex h3 mb-0">
      <a class="bg-faded text-center py-3 w-75" href="<?= route(Users::class) ?>">
        <i class="fa fa-user"></i>
      </a>
      <a class="bg-success text-white text-center py-3 w-25" href="<?= route(Users\Manage::class) ?>">
        <i class="fa fa-plus"></i>
      </a>
    </div>
    <div class="bg-faded">
      <?= $this->tashaci() ?>
    </div>
    <?php
  }

  abstract public function tashaci();
}
