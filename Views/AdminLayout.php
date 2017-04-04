<?php

namespace Manix\Brat\Utility\Admin\Views;

use Manix\Brat\Components\Views\HTML\HTMLDocument;
use Manix\Brat\Utility\Admin\Controllers\Features\Home;
use Manix\Brat\Utility\Admin\Controllers\Features\Profile;
use const SITE_URL;
use function html;

abstract class AdminLayout extends HTMLDocument {

    public function html() {
        $this->cacheT8('manix/util/admin');
        ?>

        <!DOCTYPE html>
        <html lang="en">
            <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

                <?= $this->head() ?>
            </head>
            <body class="mt-5 pt-2">
                <nav class="navbar fixed-top navbar-light flex-row flex-nowrap bg-faded p-0">
                    <div class="navbar-nav flex-row">
                        <a class="nav-item nav-link py-3 px-4" href="<?= Home::url() ?>">
                            <i class="fa fa-lg fa-home"></i>
                        </a>
                        <a class="nav-item nav-link py-3 px-4" href="<?= SITE_URL ?>">
                            <i class="fa fa-lg fa-eye"></i>
                        </a>
                    </div>

                    <div class="navbar-nav ml-auto text-nowrap">
                        <?php if (isset($this->data['adminuser'])): ?>
                            <div class="nav dropdown">
                                <a href="#" class="nav-link dropdown-toggle p-3" data-toggle="dropdown">
                                    <i class="fa fa-user mr-1"></i>
                                    <?= html($this->data['adminuser']['name']) ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= Profile::url() ?>">
                                        <?= $this->t8('profile') ?>
                                    </a>
                                    <a class="dropdown-item" href="#" id="admLogout">
                                        <?= $this->t8('logout') ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>

                <?= $this->body() ?>

                <!-- jQuery first, then Tether, then Bootstrap JS. -->
                <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
                <script>
                    $("#admLogout").click(function () {
                        $.ajax({
                            type: 'DELETE',
                            url: '<?= SITE_URL, '/admin/adminauth' ?>'
                        }).done(function () {
                            window.location.reload();
                        });
                    });
                </script>
            </body>
        </html>

        <?php
    }

}
