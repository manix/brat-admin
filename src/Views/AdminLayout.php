<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Helpers\HTMLGenerator;
use Manix\Brat\Utility\Admin\Controllers\Home;
use Project\Views\Layouts\DefaultLayout;
use function config;
use function route;

abstract class AdminLayout extends DefaultLayout {

  public function __construct($data, HTMLGenerator $html) {
    parent::__construct($data, $html);

    $this->title = config('project')['name'] . ' - ' . $this->t8('manix/util/admin', 'administration');
  }

  public function body() {
    ?>
    <style>html{background-color:lightgray;}body{background-color:transparent}</style>
    <a href="<?= route(Home::class) ?>" class="d-block text-center py-5 bg-primary text-white">
      <?= $this->t8('manix/util/admin', 'administration') ?>
    </a>
    <?php
    echo $this->content();
  }

  abstract public function content();
}
