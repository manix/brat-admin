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

  public function permissions_id() {
    return 'permissions';
  }

  public function getColumns() {
    return ['feature_id', 'group_id', 'readonly'];
  }

  public function getEditableColumns() {
    return ['feature_id', 'group_id', 'readonly'];
  }

  public function getSearchableColumnsFiltered() {
    return ['group_id', 'feature_id'];
  }

  public function getSearchableColumnsUnfiltered() {
    return ['group_id'];
  }

  public function getFeaturesForInput() {
    $features = [];

    foreach (Features::getAll() as $feature) {
      $id = (string)$feature->permissions_id();
      if (!isset($features[$id])) {
        $features[$id] = $feature->name() . ' [' . $id . ']';
      }
    }

    return $features;
  }

  private function extractFeatureData(&$map, $features) {
    foreach ($features as $feature) {
      $map[(string)$feature->id()] = $feature->name();

      if ($feature instanceof FeatureIndex) {
        $this->extractFeatureData($map, $feature->features());
      }
    }
  }

  public function getDefaultListView() {
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
    $feature->setAttribute('selected', $_GET['feature_id']);
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

  public function after($data) {
    $data = parent::after($data);
    
    if (($data['success'] ?? 0) === true && isset($data['model'])) {
      cache()->wipe('acl/perm/' . $data['model']->feature_id);
    }

    return $data;
  }

}
