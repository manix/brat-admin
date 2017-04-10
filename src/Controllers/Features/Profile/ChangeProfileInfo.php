<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Profile;

use Manix\Brat\Components\Validation\Validator;
use Manix\Brat\Utility\Admin\Controllers\Features\Profile;
use Manix\Brat\Utility\Admin\Models\AdminUserRuleset;

class ChangeProfileInfo extends Profile {

    public function put() {
        $ruleset = new AdminUserRuleset();
        $validator = new Validator();

        if (!$validator->validate($_POST, $ruleset)) {
            return $this->get($validator->getErrors(), $ruleset);
        }

        echo "PROFILE<pre>" . print_r($_POST, true) . "</pre>";
        exit;
    }

}
