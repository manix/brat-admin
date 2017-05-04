<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Utility\Admin\Controllers\Users\Manage;
use Manix\Brat\Utility\Admin\Controllers\Users\Privileges;
use function html;
use function route;

class UsersView extends UsersLayout {

  public function tashaci() {
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><i class="fa fa-hashtag"></i></th>
          <th><?= $this->t8('manix/util/users/common', 'name') ?></th>
          <th><?= $this->t8('manix/util/users/common', 'emails') ?></th>
          <th><i class="fa fa-pencil"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($this->data['users'] as $user):
          $url = route(Privileges::class, ['id' => $user->id])
          ?>
          <tr>
            <td><?= $user->id ?></td>
            <td><?= html($user->name) ?></td>
            <td>
              (<?= $user->emails->count() ?>) 
              <?= implode(', ', $user->emails->items()) ?>
            </td>
            <td>
              <?php if ($user->admin->count()): ?>
                <a href="<?= $url ?>" class="btn btn-primary btn-sm">
                  <i class="fa fa-pencil"></i>
                </a>
              <?php else: ?>
                <a href="<?= $url ?>" class="btn btn-success btn-sm">
                  <i class="fa fa-plus"></i>
                </a>
              <?php endif; ?>
              <a href="<?= route(Manage::class, ['id' => $user->id]) ?>" class="btn btn-secondary btn-sm">
                <i class="fa fa-list"></i>
              </a>
              <a href="<?= route(Manage::class, ['delete' => true, 'id' => $user->id]) ?>" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php
  }

}
