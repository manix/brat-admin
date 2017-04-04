<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Profile;

use Manix\Brat\Components\Validation\Validator;
use Manix\Brat\Utility\Admin\Controllers\Features\Profile;
use Manix\Brat\Utility\Admin\Models\AdminUserRuleset;

class ChangePassword extends Profile {

    public function get(array $errors = array(), $rules = null) {
        return parent::get($errors, $rules);
    }
    
    public function put() {
        $this->data['dgd'] = true;
        echo "<pre>" . print_r($this->data, true) . "</pre>";
        
        return $this->get();

        $ruleset = new AdminUserRuleset();
        $validator = new Validator();

        if (!$validator->validate($_POST, $ruleset)) {
            return $this->get($validator->getErrors(), $ruleset);
        }

        echo "PASSWR<pre>" . print_r($_POST, true) . "</pre>";
        exit;
    }

}
