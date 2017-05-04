<?php

namespace Manix\Brat\Utility\Admin\Controllers\Users;

use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Helpers\HTMLGenerator;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Controllers\UsersFeature;
use Manix\Brat\Utility\Admin\Views\UsersLayout;
use Manix\Brat\Utility\Admin\Views\UsersSubHeader;
use Manix\Brat\Utility\CRUD\CRUDController;
use Manix\Brat\Utility\CRUD\CRUDViewTrait;
use Manix\Brat\Utility\Users\Controllers\Mailer;
use Manix\Brat\Utility\Users\Models\UserEmailGateway;
use Manix\Brat\Utility\Users\Models\UserGateway;

class Emails extends CRUDController implements AdminFeature {

  use UsersFeature,
      Mailer;

  public $page = EmailsManageView::class;

  protected function constructGateway(): Gateway {
    return new UserEmailGateway;
  }

  protected function fetchModel($pk) {
    $gate = new UserGateway();

    $this->getGateway()->join('user', $gate);

    $model = parent::fetchModel($pk);

    $this->getGateway()->unjoin('user');

    return $model;
  }

  public function put() {
    if ($_POST['send_verify_mail'] ?? null) {
      $this->getModel()->invalidate();

      $this->page = VerifyMailSent::class;
      
      return [
          'success' => $this->getGateway()->persist($this->getModel()) && $this->sendActivationMail($this->getModel())
      ];
    } else {
      return parent::put();
    }
  }

  protected function constructCreateForm(Form $form) {
    $form = parent::constructCreateForm($form);

    if ($_GET['user_id'] ?? null) {
      $form->input('user_id')->value = $_GET['user_id'];

      $this->data['user'] = (new UserGateway)->find($_GET['user_id'])->first();
    }

    return $form;
  }

  protected function constructUpdateForm(Form $form) {
    $form = parent::constructUpdateForm($form);

    $form->input('user_id')->type = 'hidden';

    return $form;
  }

}

class EmailsManageView extends UsersLayout {

  use CRUDViewTrait,
      UsersSubHeader {
    constructFormView as cfv;
  }

  public function __construct($data, HTMLGenerator $html) {

    parent::__construct($data, $html);

    if ($data['success'] ?? null) {
      header('Location: ' . $data['goto'] ?? null);
      exit;
    }
  }

  protected function constructFormView(Form $form) {
    $view = $this->cfv($form);

    $view->setCustomRenderer('manix-save', function($input) {
      ?>
      <div class="d-flex justify-content-end">
        <button type="submit" name="send_verify_mail" value="1" class="btn btn-secondary mr-2">
          Send verification mail
        </button>
        <?= $input->setAttribute('class', 'btn btn-secondary')->toHTML($this->html) ?>
      </div>
      <?php
    });

    return $view;
  }

  public function tashaci() {
    if ($this->data['model'] ?? null) {
      $user = $this->data['model']->user->first() ?? null;
    } elseif ($_GET['user_id']) {
      $user = $this->data['user'];
    }

    $this->renderHeader($user);
    ?>

    <div class="container-fluid py-3">
      <?= $this->form() ?>
    </div>
    <?php
  }

}

class VerifyMailSent extends UsersLayout {

  public function tashaci() {
    ?>

    <?php if ($this->data['success'] ?? null): ?>
      <div class="alert alert-success">Mail sent to <?= html($this->data['model']->email) ?>!</div>
    <?php else: ?>
      <div class="alert alert-danger">Mail not sent to <?= html($this->data['model']->email) ?>!</div>
    <?php endif; ?>

    <?php
  }

}
