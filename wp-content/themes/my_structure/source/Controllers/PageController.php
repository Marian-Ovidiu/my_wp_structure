<?php

namespace Controllers;

use Core\Bases\BaseController;
use Models\GalleriaFields;
use Models\AziendeFields;

class PageController extends BaseController {
    public function galleria()
    {
        $this->addJs('highlight', 'highlight.js', ['stripe'], true);
        $this->addVarJs('highlight', 'highlights', GalleriaFields::get()->highlights);

        $this->render('galleria', ['galleria' => GalleriaFields::get()]);
    }

    public function aziende()
    {
        $fields = AziendeFields::get();
        $this->render('aziende', ['fields' => $fields]);
    }
}
