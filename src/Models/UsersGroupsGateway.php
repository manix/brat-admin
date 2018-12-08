<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Utility\Users\Models\UserGateway;
use Project\Models\DefaultGateway;

class UsersGroupsGateway extends DefaultGateway {

  protected $table = 'manix_users_groups';
  protected $fields = [
      'user_id',
      'group_id'
  ];
  protected $pk = ['user_id', 'group_id'];
  protected $rel = [
      'user' => [UserGateway::class, 'user_id', 'id', true],
      'group' => [GroupsGateway::class, 'group_id', 'id', true]
  ];
  public $timestamps = true;

}
