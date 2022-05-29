<?php

namespace Manix\Brat\Utility\Admin\Controllers\Features\Permissions;

use Manix\Brat\Components\Forms\Form;
use Manix\Brat\Components\Persistence\Gateway;
use Manix\Brat\Components\Validation\Ruleset;
use Manix\Brat\Utility\Admin\Controllers\AdminFeatureCRUDController;
use Manix\Brat\Utility\Admin\Controllers\Features\Groups\Index as GIndex;
use Manix\Brat\Utility\Admin\Models\Features;
use Manix\Brat\Utility\Admin\Views\PermissionsListView;
use Project\Traits\Admin\AdminGatewayFactory;
use Manix\Brat\Utility\Admin\Controllers\FeatureIndex;

class Index extends AdminFeatureCRUDController {

  use AdminGatewayFactory;

  public function id() {
    return 1.2;
  }

  public function getColumns() {
    return ['feature_id', 'group_id', 'readonly'];
  }

  public function getEditableFields() {
    return ['feature_id', 'group_id', 'readonly'];
  }

  public function getFeaturesForInput() {
    return Features::getAll();
  }

  public function getListView() {
    return PermissionsListView::class;
  }

  protected function constructCreateForm(Form $form) {
    $form = parent::constructCreateForm($form);
    $form->add('feature_id', 'select', $this->getFeaturesForInput());
    $form->add('readonly', 'bool');
    return $form;
  }

  protected function constructCreateRules(Ruleset $rules) {
    $rules->add('feature_id')->required();
    $rules->add('group_id')->required();
    return $rules;
  }

  protected function constructUpdateForm(Form $form) {
    $form = parent::constructUpdateForm($form);
    $feature = $form->input('feature_id');
    $feature->setAttribute('selected', $feature->value);
    $feature->type = 'select';
    $feature->value = $this->getFeaturesForInput();
    $form->input('readonly')->type = 'bool';
    return $form;
  }

  protected function constructUpdateRules(Ruleset $rules) {
    return $this->constructCreateRules($rules);
  }

  public function getRelations() {
    return [
        'group' => GIndex::class
    ];
  }

  protected function constructGateway(): Gateway {
    $gate = $this->instantiate($this->permissionsGateway());
    $gate->join('group');

    return $gate;
  }

  public function description() {
    return 'Manage permissions';
  }

  public function name() {
    return 'Permissions';
  }

  public function icon() {
    return 'lock';
  }

}

