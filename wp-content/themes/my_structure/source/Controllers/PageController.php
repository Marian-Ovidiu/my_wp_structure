<?php
namespace Controllers;

use Core\Bases\BaseController;
use Models\AziendeFields;
use Models\GalleriaFields;
use Models\Grazie;
use Models\Progetti;
use Models\Progetto;

class PageController extends BaseController
{
    public function galleria()
    {
        $this->addJs('highlight', 'highlight.js', [], true);
        $this->addVarJs('highlight', 'highlights', GalleriaFields::get()->highlights);
        $this->render('galleria', ['galleria' => GalleriaFields::get()]);
    }

    public function aziende()
    {
        $fields = AziendeFields::get();
        $this->render('aziende', ['fields' => $fields]);
    }
    public function grazie()
    {
        $fields = Grazie::get();
        $this->render('grazie', ['fields' => $fields]);
    }

    public function progetti()
    {
        $fields   = Progetti::get();
        $progetti = [];
        foreach ($fields->progetti as $progetto) {
            $progetti[] = Progetto::find($progetto);
        }
        $fields->progetti   = $progetti;
        $this->render('archivio-progetto', [
            'fields' => $fields,
        ]);
    }
}
