<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Utility\Users\Models\UserGateway;
use Project\Models\DefaultGateway;

class AccessLogGateway extends DefaultGateway {

  protected $table = 'manix_access_log';
  protected $fields = [
      'user_id',
      'created',
      'feature_id',
      'payload'
  ];
  protected $pk = ['user_id', 'created'];
  protected $rel = [
      'user' => [UserGateway::class, 'user_id', 'id']
  ];

}
