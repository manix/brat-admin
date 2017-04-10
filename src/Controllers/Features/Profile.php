<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features;

use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Utility\Admin\Controllers\Feature;
use Manix\Brat\Utility\Admin\Controllers\Features\Profile\ChangePassword;
use Manix\Brat\Utility\Admin\Controllers\Features\Profile\ChangeProfileInfo;
use Manix\Brat\Utility\Admin\Models\AdminUser;
use Manix\Brat\Utility\Admin\Models\AdminUserRuleset;
use Manix\Brat\Utility\Admin\Views\AdminProfileView;
use const MANIX;

class Profile extends Feature {

    public $page = AdminProfileView::class;

    public function get(array $errors = [], $rules = null) {
        echo "<pre>" . print_r($this->data, true) . "</pre>";
        
        $form = new Form();
        $form->setMethod('PUT');
        $form->setAction(ChangeProfileInfo::url());
        $form->add('name', 'hidden');
        $form->add('email', 'email');
        $form->add('display_name', 'text');
        $form->add('', 'submit', 'Save changes');
        $form->html5up($rules ?? new AdminUserRuleset());
        $form->errors = $errors;
        $form->fill(empty($_POST) ? $_SESSION[MANIX]['admin']['user'] : $_POST);

        $pform = new Form();
        $pform->setMethod('PUT');
        $pform->setAction(ChangePassword::url());
        $pform->add('current_password', 'password');
        $pform->add('new_password', 'password');
        $pform->add('repeat_new', 'password');
        $pform->add('', 'submit', 'Change');
        $pform->errors = $errors;

        return [
            'profileForm' => $form,
            'passForm' => $pform
        ];
    }

    public function getDescription(): string {
        
    }

    public function getDisplayName(): string {
        
    }

    public function getId(): int {
        
    }

    public function accessControl(AdminUser $user): bool {
        return isset($user);
    }

}
