<?php

namespace Manix\Brat\Utility\Admin\Views;

class AdminLoginView extends AdminLayout {

    public function body() {
        $this->cacheT8('manix/util/admin');
        ?>
        <div class="text-center mt-md-5">
            <div class="d-inline-block mt-sm-5">
                <?php if (isset($this->data['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $this->data['error'] ?>
                    </div>
                <?php elseif (!empty($this->data['success'])): ?>
                    <div class="alert alert-success">
                        LOGGED IN!
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="card">
                        <div class="card-block">
                            <h2 class="card-title mb-5"><?= $this->t8('loginTitle') ?></h2>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="px-1 fa-lg fa fa-user"></i>
                                    </span>
                                    <input name="username" type="text" class="form-control form-control-lg" value="<?= html($_POST['username'] ?? null) ?>">
                                </div>
                            </div>
                            <div class="form-group mb-4 pb-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="px-1 fa-lg fa fa-lock"></i>
                                    </span>
                                    <input name="password" type="password" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    <?= $this->t8('login') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
    }

}
