<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Groups;

use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Utility\Admin\Controllers\AdminFeatureCRUDController;
use Manix\Brat\Utility\Admin\Views\GroupsListView;
use Project\Traits\Admin\AdminGatewayFactory;

class Index extends AdminFeatureCRUDController {

  use GroupsFeature,
      AdminGatewayFactory;

  protected function constructGateway(): Gateway {
    return $this->instantiate($this->groupsGateway());
  }

  public function getRelations() {
    return [
        'members' => ['members', Members::class, [
                'group_id' => 'equals'
            ]]
    ];
  }

  public function getListView() {
    return GroupsListView::class;
  }

  public function getColumns() {
    return ['id', 'name', 'created', 'updated', 'members'];
  }

  public function getSearchableColumns() {
    return ['id', 'name'];
  }

  public function getEditableFields() {
    return ['name'];
  }

  public function getSortableColumns() {
    return ['id', 'name', 'created', 'updated'];
  }

  public function description() {
    return 'Manage groups';
  }

  public function icon() {
    return 'users';
  }

  public function name() {
    return 'Groups';
  }

}
