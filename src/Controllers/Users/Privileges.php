<?php

namespace Manix\Brat\Utility\Admin\Controllers\Users;

use Exception;
use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Utility\Admin\Controllers\Users;
use Manix\Brat\Utility\Admin\Models\AdminPatchedUserGateway;
use Manix\Brat\Utility\Admin\Models\UserAdmin;
use Manix\Brat\Utility\Admin\Models\UserAdminGateway;
use Manix\Brat\Utility\Admin\Views\UsersPrivilegesView;
use Manix\Brat\Utility\Users\Models\Auth;

class Privileges extends Users {

  public $page = UsersPrivilegesView::class;

  public function get() {
    $gate = new AdminPatchedUserGateway();
    $gate->join('admin', new UserAdminGateway());

    $user = $gate->find($_GET['id'] ?? null)->first();

    if (!$user) {
      throw new Exception('not found', 404);
    }

    $form = new Form();
    $form->setMethod('PUT');

    $form->addCollection('privileges', function($form) use($user) {
      foreach ($this->getFeatures() as $feature) {

        $input = $form->add($feature->id(), 'checkbox')
        ->setAttribute('feature', $feature);

        $admin = $user->admin->first();

        if ($admin && $feature->accessControl($admin)) {
          $input->setAttribute('checked', 'checked');
        }
      }

      return $form;
    });

    return [
        'form' => $form,
        'user' => $user
    ];
  }

  public function put() {
    $admin = new UserAdmin([
        'user_id' => $_GET['id']
    ]);

    foreach (array_keys($_POST['privileges'] ?? []) as $id) {
      $admin->addPrivilege($id);
    }

    $gate = new UserAdminGateway;

    if (!$gate->persist($admin)) {
      throw new Exception('unexpected', 500);
    }

    $user = Auth::getCached($admin->user_id);

    if ($user) {
      $user->admin = $admin;
      Auth::updateCache($user);
    }

    return $this->get();
  }

}
