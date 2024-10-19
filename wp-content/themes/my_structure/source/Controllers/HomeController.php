<?php

namespace Controllers;

use Core\Bases\BaseController;
use Models\HomeFields;

class HomeController extends BaseController {
    public function index() {

        $data = HomeFields::get(get_the_ID());
        $this->addJs('homeSlider', 'homeSlider.js');
        $this->addCss('homeSlider', 'homeSlider.css');
        /*$this->addVarJs('testAjax', 'var_test', ['foo' => 'bar'], true);*/
        $this->render('home', ['data'=> $data]);
    }
}
