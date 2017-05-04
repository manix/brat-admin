<?php

namespace Manix\Brat\Utility\Admin\Controllers\Users;

use Manix\Brat\Components\Criteria;
use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Helpers\HTMLGenerator;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Controllers\Users;
use Manix\Brat\Utility\Admin\Controllers\UsersFeature;
use Manix\Brat\Utility\Admin\Views\UsersLayout;
use Manix\Brat\Utility\Admin\Views\UsersSubHeader;
use Manix\Brat\Utility\CRUD\CRUDController;
use Manix\Brat\Utility\CRUD\CRUDViewTrait;
use Manix\Brat\Utility\Users\Models\Auth;
use Manix\Brat\Utility\Users\Models\UserEmailGateway;
use Manix\Brat\Utility\Users\Models\UserGateway;
use function html;
use function route;

class Manage extends CRUDController implements AdminFeature {

  use UsersFeature,
      UsersSubHeader;

  public $page = UsersManageView::class;

  public function put() {
    if (empty($_POST['password'])) {
      unset($_POST['password']);
    }

    $result = parent::put();

    if (Auth::getCached($this->getModel()->id)) {
      Auth::updateCache($this->getModel());
    }

    return $result;
  }

  protected function constructCreateForm(Form $form) {
    $form = parent::constructCreateForm($form);
    $form->remove('id');
    $form->input('password')->setAttribute('type', 'password');

    return $form;
  }

  protected function constructUpdateForm(Form $form) {
    $form = parent::constructUpdateForm($form);
    $form->input('password')->setAttribute('type', 'password');

    $gate = new UserEmailGateway();
    $criteria = new Criteria;
    $criteria->equals('user_id', $this->getModel()->id);

    $form->add('emails', 'text')->setAttribute('emails', $gate->findBy($criteria));

    return $form;
  }

  protected function afterDelete() {
    return route(Users::class);
  }

  protected function constructGateway(): Gateway {
    return new UserGateway;
  }

}

class UsersManageView extends UsersLayout {

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

    $view->setCustomRenderer('emails', [$this, 'listEmails']);

    return $view;
  }

  public function listEmails($input) {
    ?>
    <h4>
      <span><?= $this->t8('manix/util/users/common', 'emails') ?></span>
      <a class="btn btn-success btn-sm" href="<?= route(Emails::class, ['user_id' => $this->data['model']->id]) ?>">
        <i class="fa fa-plus"></i>
      </a>
    </h4>

    <div class="list-group">
      <?php foreach ($input->getAttribute('emails') as $e): ?>
        <div class="list-group-item d-flex justify-content-between">
          <?= html($e->email) ?>
          <a href="<?= route(Emails::class, ['email' => $e->email]) ?>" class="btn btn-secondary btn-sm">
            <i class="fa fa-pencil"></i>
          </a>

        </div>
      <?php endforeach; ?>
    </div>
    <?php
  }

  public function tashaci() {
    if ($this->data['model']) {
      $this->renderHeader($this->data['model']);
    }
    ?>

    <div class="container-fluid py-3">
      <?= $this->form() ?>
    </div>
    <?php
  }

}
