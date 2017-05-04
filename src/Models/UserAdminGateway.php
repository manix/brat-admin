<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Components\Model;
use Project\Models\DefaultGateway;

class UserAdminGateway extends DefaultGateway {

    const MODEL = UserAdmin::class;

    protected $table = 'manix_users_admins';
    protected $fields = [
        'user_id',
        'privileges'
    ];
    protected $pk = ['user_id'];
    
    public function persist(Model $model, array $fields = null): bool {
      $priv = $model->privileges;
      $model->privileges = json_encode($model->privileges);
      
      $result = parent::persist($model, $fields);
      
      $model->privileges = $priv;
      
      return $result;
    }

}
