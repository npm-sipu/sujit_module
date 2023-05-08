<?php

namespace Drupal\custom_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomController extends ControllerBase
{

    public function hello()
    {
        return [
            '#markup' => "<h1>Hello World</h1>",
        ];
    }

}