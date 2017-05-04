<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Utility\Users\Models\User;

trait UsersSubHeader {

  public function renderHeader(User $user) {
    ?>

    <div class="list-group-item align-items-center">
      <div class="p-2 text-center">
        <?= '#', $user->id, ' ', html($user->name) ?>
      </div>
    </div>
    <?php
  }

}
