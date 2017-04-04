<?php

namespace Manix\Brat\Utility\Admin\Controllers;

use Exception;
use Manix\Brat\Utility\Admin\Controllers\Features\Home;
use function loader;

class Index extends AdminAccess {

    public function __call($name, $arguments) {
        global $manix;

        $class = $_GET['id'] ?? Home::class;

        if ($class === null || !loader()->loadClass($class) || !is_subclass_of($class, Feature::class)) {
            throw new Exception('Feature not found', 404);
        }

        $program = $manix->program();
        $controller = new $class();

        exit($program->respond(array_merge($controller->data(), $controller->{$name}(...$arguments)), $controller));
    }

}
