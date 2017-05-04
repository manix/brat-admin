<?php

namespace Manix\Brat\Utility\Admin\Views\Cache;

use Manix\Brat\Helpers\FormViews\DefaultFormView;

class CacheView extends CacheLayout {

  public function podka() {
    $form = $this->data['form'];
    $form->input('key')->setAttribute('class', 'form-control p-3')
    ->setAttribute('placeholder', 'Key');
    $form->input('')->setAttribute('class', 'hidden-xs-up');

    $view = new DefaultFormView($form, $this->html);
    $view->setCustomRenderer('key', [$this, 'renderInput']);
    $view->setCustomRenderer('', [$this, 'renderInput']);

    echo $view;
    ?>

    <?php if ($this->data['value'] !== null): ?>
      <pre class="bg-faded p-2"><?php print_r($this->data['value']) ?></pre>
    <?php endif; ?>

    <?php
  }

  public function renderInput($input) {
    echo $input->toHTML($this->html);
  }

}
