<?php

namespace Manix\Brat\Utility\Admin\Views;

class UsersPrivilegesView extends AdminLayout {

  public function content() {
    if (!$this->data['user']) {
      return;
    }
    
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
        <?php foreach ($this->data['users'] as $user): ?>
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
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php
  }

}
