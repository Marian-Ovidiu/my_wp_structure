<?php

namespace Controllers;

use Core\Bases\BaseController;
use Models\GalleriaFields;

class PageController extends BaseController {
    public function galleria()
    {
        $this->addJs('highlight', 'highlight.js', ['stripe'], true);
        $this->addVarJs('highlight', 'highlights', [
            'Dedizione.',
            'Coraggio.',
            'Passione.',
        ]);

        $this->render('galleria', ['galleria' => GalleriaFields::get()]);
    }
}
