<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Forms\FormInput;
use Manix\Brat\Helpers\FormViews\FormView;

class UsersPrivilegesView extends UsersLayout {

  use UsersSubHeader;

  public function tashaci() {
    if (!$this->data['user']) {
      return;
    }

    $this->data['form']->setAttribute('class', 'list-group');
    $this->data['form']->add('dummy_for_render', 'text', $this->data['user']->name);

    $form = new class($this->data['form'], $this->html) extends FormView {

      public function renderInput(FormInput $input) {
        $f = $input->getAttribute('feature');
        $input->removeAttribute('feature');
        ?>
        <label class="list-group-item d-flex justify-content-between privilege">
          <div>
            <?php if ($f->icon()): ?>
              <i class="fa fa-<?= $f->icon() ?> mr-2"></i>
            <?php endif; ?>
            <span><?= $f->name() ?></span>
          </div>
          <?= $input->setAttribute('class', 'priv-cb')->toHTML($this->html) ?>
          <i class="fa fa-check text-success fa-lg"></i>
          <i class="fa fa-times text-danger fa-lg"></i>
        </label>
        <?php
      }
    };

    $form->setCustomRenderer('dummy_for_render', function($input) {
      ?>
      <div class="d-flex justify-content-end">
        <button class="btn-block btn-lg btn btn-secondary" type="submit">
          <i class="fa fa-save fa-lg"></i>
        </button>
      </div>
      <?php
    });
    ?>

    <style>
      .priv-cb { display: none; }
      .fa-check { display: none; }
      .priv-cb:checked ~ .fa-check { display: block; }
      .priv-cb:checked ~ .fa-times { display: none; }
      .list-group-item.privilege:hover { background-color: #f1f1f1; }
    </style>

    <?= $this->renderHeader($this->data['user']) ?>

    <?= $form ?>

    <?php
  }

}
