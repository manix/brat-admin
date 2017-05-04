<?php

namespace Manix\Brat\Utility\Admin\Controllers\Cache;

use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Components\Validation\Ruleset;
use Manix\Brat\Utility\Admin\Controllers\Cache;
use Manix\Brat\Utility\Admin\Views\Cache\CacheWriteView;
use function cache;
use function route;

class Write extends Cache {

  public $page = CacheWriteView::class;

  public function get() {
    return [
        'form' => $this->getForm()
    ];
  }

  public function post() {
    return $this->validate($_POST, function($data) {
      cache($data['key'], $data['value']);

      header('Location: ' . route(parent::class, ['key' => $data['key']]));
      exit;
    });
  }

  protected function constructForm(Form $form): Form {
    $form->add('key', 'text');
    $form->add('value', 'text');

    return $form;
  }

  protected function constructRules(Ruleset $rules): Ruleset {
    $rules->add('key')->required();
    $rules->add('value')->required();

    return $rules;
  }

}
