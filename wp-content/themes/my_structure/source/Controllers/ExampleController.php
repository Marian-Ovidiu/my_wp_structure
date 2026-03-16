<?php

namespace Controllers;

use Core\Bases\BaseController;

class ExampleController extends BaseController
{
    public function demo()
    {
        $this->render('pages.demo', [
            'siteName' => get_bloginfo('name'),
            'siteDescription' => get_bloginfo('description'),
        ]);
    }
}
