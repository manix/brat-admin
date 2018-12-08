<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Views\HTML\HTMLElement;

class FeatureView extends HTMLElement {

  public function html() {
    $feature = $this->data[0];

    if ($feature->hidden() && !$this->option('showHidden')) {
      return;
    }
    ?>

    <?php if ($this->option('notClickable')): ?>
      <div class="card">
        <?= $this->renderBody($feature) ?>
      </div>
    <?php else: ?>
      <a href="<?= route(get_class($feature)) ?>"  class="card text-dark">
        <?= $this->renderBody($feature) ?>
      </a>
    <?php
    endif;
  }

  public function renderBody($feature) {
    if ($feature->image() && !$this->option('hideImage')):
      ?>
      <img class="card-img-top img-fluid" src="<?= html($feature->image()) ?>" alt="Card image cap">
    <?php endif; ?>
    <div class="card-header h4 mb-0 d-flex justify-content-between">
      <div>
        <?php if ($feature->icon() && !$this->option('hideIcon')): ?>
          <i class="fa fa-<?= html($feature->icon()) ?> fa-lg mr-2"></i>
        <?php endif; ?>
        <span><?= html($feature->name()) ?></span>
      </div>
    </div>
    <?php if ($feature->description() && !$this->option('hideDesc')): ?>
      <div class="card-body">
        <small class="text-muted"><?= html($feature->description()) ?></small>
      </div>
      <?php
    endif;
  }

  public function option($option) {
    return isset($this->data[1]) ? ($this->data[1][$option] ?? null) : null;
  }

}
