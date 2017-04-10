<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Forms\DefaultFormView;
use Manix\Brat\Components\Forms\Form;
use function html;

class AdminProfileView extends AdminLayout {

    public function body() {
        $formView = new DefaultFormView(new Form, $this->html);
        echo "<pre>" . print_r($this->data, true) . "</pre>";
        ?>
        <div class="jumbotron text-center">
            <h3><?= html($this->data['adminuser']['name']) ?></h3>
        </div>
        <div class="container">
            <?php if (isset($this->data['success'])): ?>
                <div class="alert alert-success">
                    Changes saved.
                </div>
            <?php endif; ?>

            <div class="card-deck">
                <div class="card">
                    <div class="card-header">
                        Edit profile info.
                    </div>
                    <div class="card-block">
                        <?= $formView->data($this->data['profileForm']) ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Change password.
                    </div>

                    <div class="card-block">
                        <?= $formView->data($this->data['passForm']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
