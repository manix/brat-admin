<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Model;
use Manix\Brat\Utility\CRUD\CRUDListView;

class GroupsMembersListView extends CRUDListView {

  public function renderColumnLabel($field) {
    switch ($field) {
      case 'group_id': return 'Group';
      case 'user_id': return 'User';
      default: return parent::renderColumnLabel($field);
    }
  }

  public function renderActionButtonEdit($pk) {

  }

  public function renderRelationAnchorText(Model $model, $field) {
    switch ($field) {
      case 'user_id': return $model->user->name;
      default: return parent::renderRelationAnchorText($model, $field);
    }
  }

}
