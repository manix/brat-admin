<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Model;
use Manix\Brat\Utility\Admin\Models\Features;
use Manix\Brat\Utility\CRUD\CRUDListView;
use function html;

class PermissionsListView extends CRUDListView {

  public function renderColumnBody(Model $model, $field) {
    switch ($field) {
      case 'feature_id':
        $feature = Features::get($model->feature_id);
        ?>
        <div>
          <div><?= $feature ? $feature->name() : null ?></div>
          <div class="small text-muted">#<?= html($model->feature_id) ?></div>
        </div>
        <?php
        break;

      default: return parent::renderColumnBody($model, $field);
    }
  }

  public function renderRelationAnchor(Model $model, $field) {
    switch ($field) {
      case 'group_id':
        ?>
        <a class="d-block" href="<?= $this->getRelationHref('group_id', $model->group_id) ?>">
          <div><?= html($model->group->name) ?></div>
          <div class="small text-muted">#<?= $model->group_id ?></div>
        </a>
        <?php
        break;

      default: return parent::renderRelationAnchor($model, $field);
    }
  }

}
