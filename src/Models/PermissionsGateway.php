<?php

namespace Manix\Brat\Utility\Admin\Models;

use Project\Models\DefaultGateway;

class PermissionsGateway extends DefaultGateway {

  protected $table = 'manix_permissions';
  protected $fields = [
      'feature_id',
      'group_id',
      'readonly'
  ];
  protected $pk = ['feature_id', 'group_id'];
  protected $rel = [
      'group' => [GroupsGateway::class, 'group_id', 'id', true]
  ];

}
