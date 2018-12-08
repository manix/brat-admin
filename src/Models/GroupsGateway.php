<?php

namespace Manix\Brat\Utility\Admin\Models;

use Project\Models\DefaultGateway;

class GroupsGateway extends DefaultGateway {

  protected $table = 'manix_groups';
  protected $fields = [
      'id',
      'name'
  ];
  protected $pk = ['id'];
  protected $rel = [
      'members' => [UsersGroupsGateway::class, 'id', 'group_id']
  ];
  public $timestamps = true;

}
