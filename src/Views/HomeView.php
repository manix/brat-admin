<?php

namespace Manix\Brat\Utility\Admin\Views;

class HomeView extends AdminLayout {

  public function content() {
    ?>

    <div class="container-fluid p-0">
      <?= new FeatureView([$this->data['ctrl']], $this->html) ?>

      <div class="card-columns" style="column-gap:0">
        <?php
        foreach ($this->data['features'] as $feature) {
          echo new FeatureView([$feature], $this->html);
        }
        ?>
      </div>
    </div>
    <?php
  }

}
