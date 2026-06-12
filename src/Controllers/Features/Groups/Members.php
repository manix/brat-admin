<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Groups;

use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Utility\Admin\Controllers\AdminFeatureCRUDController;
use Manix\Brat\Utility\Admin\Controllers\Features\Users\Index as UIndex;
use Manix\Brat\Utility\Admin\Views\GroupsMembersListView;
use Manix\Brat\Utility\Users\Models\Auth;
use Project\Traits\Admin\AdminGatewayFactory;

class Members extends AdminFeatureCRUDController {

  use GroupsFeature,
      AdminGatewayFactory;

  protected function constructGateway(): Gateway {
    $gate = $this->instantiate($this->usersGroupsGateway());
    $gate->join('user', ['id', 'name'])->timestamps(false);
    return $gate;
  }

  public function getEditableFields() {
    return ['group_id', 'user_id'];
  }

  public function getRelations() {
    return [
        'group' => ['group_id', Index::class],
        'user' => ['user_id', UIndex::class],
    ];
  }

  public function getColumns() {
    return ['user_id', 'created'];
  }

  public function getSortableColumns() {
    return [];
  }

  public function getSearchableColumns() {
    return ['group_id'];
  }

  public function requireQuery() {
    return true;
  }

  public function getListView() {
    return GroupsMembersListView::class;
  }

  public function description() {
    return 'Manage group members';
  }

  public function icon() {
    return 'users';
  }

  public function name() {
    if (isset($_GET['query'])) {
      $group = $this->instantiate($this->groupsGateway())->find($_GET['query'])->first();
      if ($group) {
        return $group->name . ' members';
      }
    }

    return 'Group not found';
  }

  public function after($data) {
    $data = parent::after($data);
    
    if (($data['success'] ?? 0) === true && isset($data['model'])) {
      $user_id = $data['model']->user_id;

      $user = Auth::getCached($user_id);
      if ($user) {
        unset($user->groups);
        Auth::updateCache($user);
      }
    }

    return $data;
  }

}
