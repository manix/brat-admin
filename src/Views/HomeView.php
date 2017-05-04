<?php

namespace Manix\Brat\Utility\Admin\Views;

class HomeView extends AdminLayout {

  public function content() {
    ?>

    <div class="container-fluid py-3">
      <div class="card-columns">
        <?php
        foreach ($this->data['features'] as $feature):
          if ($feature->hidden()) {
            continue;
          }
          ?>

          <div class="card">
            <?php if ($feature->image()): ?>
              <img class="card-img-top img-fluid" src="<?= html($feature->image()) ?>" alt="Card image cap">
            <?php endif; ?>
            <div class="card-block">
              <div class="card-title h4 mb-0 d-flex justify-content-between">
                <div>
                  <?php if ($feature->icon()): ?>
                    <i class="fa fa-<?= html($feature->icon()) ?> fa-lg mr-2"></i>
                  <?php endif; ?>
                  <span><?= html($feature->name()) ?></span>
                </div>
                <a href="<?= route(get_class($feature)) ?>" class="btn btn-secondary">
                  <i class="fa fa-chevron-right"></i>
                </a>
              </div>
            </div>
            <?php if ($feature->description()): ?>
              <div class="card-footer">
                <small class="text-muted"><?= html($feature->description()) ?></small>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php
  }

}
