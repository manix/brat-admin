<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Model;
use Manix\Brat\Utility\CRUD\CRUDListView;

class GroupsListView extends CRUDListView {

  public function renderRelationAnchor(Model $model, $field) {
    if ($field === 'members') {
      ?>
      <a href="<?= $this->getRelationHref('members', $model->id) ?>" class="btn btn-light">
        <i class="fa fa-users"></i>
      </a>
      <?php
    } else {
      echo parent::renderRelationAnchor($model, $field);
    }
  }

}
