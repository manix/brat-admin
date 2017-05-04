<?php

namespace Manix\Brat\Utility\Admin\Views\Cache;

use Manix\Brat\Helpers\FormViews\DefaultFormView;

class CacheWriteView extends CacheLayout {

  public function podka() {
    echo new DefaultFormView($this->data['form'], $this->html);
  }

}
