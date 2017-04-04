<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Components\Validation\Ruleset;

class AdminUserRuleset extends Ruleset {

    public function __construct() {
        $this->add('name')->required()->length(0, 50);
        $this->add('display_name')->length(0, 255);
        $this->add('email')->email();
    }

}
