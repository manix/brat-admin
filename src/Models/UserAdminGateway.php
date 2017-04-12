<?php

namespace Manix\Brat\Utility\Admin\Models;

use Project\Models\DefaultGateway;

class UserAdminGateway extends DefaultGateway {

    const MODEL = UserAdmin::class;

    protected $table = 'manix_users_admins';
    protected $fields = [
        'user_id',
        'privileges'
    ];
    protected $pk = ['user_id'];

}
