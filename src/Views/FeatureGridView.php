<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Views\HTML\HTMLElement;
use Manix\Brat\Utility\Admin\Models\FeatureGridMatrix;

class FeatureGridView extends HTMLElement {

  public function renderLabel($section) {

  }

  public function renderFeatures($section) {

  }

  public function renderGrid() {
    ?>
    <div class="container-fluid p-0">
      <?php
      foreach ($this->data as $section) {
        $this->renderLabel($section);
        $this->renderFeatures($section);
      }
      ?>
    </div>
    <?php
  }

  public function html() {
    if (($this->data ?? null) instanceof FeatureGridMatrix) {
      $this->renderGrid();
    } else {
      echo 'No matrix supplied';
    }
  }

}
