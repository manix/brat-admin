<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Components\Validation\Ruleset;
use Manix\Brat\Helpers\FormController;
use Manix\Brat\Utility\Admin\Controllers\AdminFeature;
use Manix\Brat\Utility\Admin\Views\Cache\CacheView;

class Cache extends FormController implements AdminFeature {

  use Feature;

  public $page = CacheView::class;

  public function id() {
    return 3;
  }

  public function get() {
    return [
        'form' => $this->getForm(),
        'value' => cache($_GET['key'] ?? null)
    ];
  }

  public function description() {
    return 'Enables CRUD in the cache via GUI.';
  }

  public function name() {
    return 'Cache Manager';
  }

  protected function constructForm(Form $form): Form {
    $form->setMethod('GET');
    $form->add('key', 'text');
    $form->add('', 'submit');
    
    $form->fill($_GET);
    
    return $form;
  }

  protected function constructRules(Ruleset $rules): Ruleset {
    return $rules;
  }

}
