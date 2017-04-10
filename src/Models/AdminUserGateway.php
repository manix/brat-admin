<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Components\Persistence\FS\FilesystemGateway;

class AdminUserGateway extends FilesystemGateway {

    const MODEL = AdminUser::class;

    protected $table = 'brat-admin-users';
    protected $fields = [
        'name',
        'display_name',
        'email',
        'password',
        'privileges'
    ];
    protected $pk = ['name'];

}
