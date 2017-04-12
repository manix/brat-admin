<?php

namespace Manix\Brat\Utility\Admin\Views;

use Project\Views\Layouts\DefaultLayout;

abstract class AdminLayout extends DefaultLayout {

  public function body() {
    ?>
    <div class="jumbotron text-center">
      <h2><?= config('project')['name'] ?></h2>
      <p>Administration</p>
    </div>
    <?php
    echo $this->content();
  }

  abstract public function content();
}
