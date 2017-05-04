<?php

namespace Manix\Brat\Utility\Admin\Models;

use Manix\Brat\Components\Model;

class UserAdmin extends Model {

  public function __construct(array $data = array()) {
    if (!empty($data['privileges'])) {
      $data['privileges'] = json_decode($data['privileges']);
    } else {
      $data['privileges'] = [];
    }

    parent::__construct($data);
  }

  public function addPrivilege($id) {
    // remove privilege if already exists
    $this->removePrivilege($id);

    $this->privileges[] = $id;
  }

  public function removePrivilege($id) {
    foreach (array_keys($this->privileges, $id, true) as $key) {
      unset($this->privileges[$key]);
    }
  }

  public function hasPrivilege($id) {
    return array_search($id, $this->privileges) !== false;
  }

}
