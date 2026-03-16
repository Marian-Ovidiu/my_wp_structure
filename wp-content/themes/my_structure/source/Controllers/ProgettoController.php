<?php
namespace Controllers;

use Core\Bases\BaseController;
use Models\Options\OpzioniArchivioProgettoFields;
use Models\Progetto;

class ProgettoController extends BaseController
{
    public function archive()
    {
        $progetti = Progetto::all();
        $opzioniArchivio = OpzioniArchivioProgettoFields::get('option');

        $this->render('archivio-progetto', [
            'progetti'        => $progetti,
            'opzioniArchivio' => $opzioniArchivio,
        ]);
    }

    public function single()
    {
        $this->addJs('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], true);
        $this->addCss('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        $this->addJs('progetto', 'progettoSlider.js', ['swiper-js'], true, '6.8.2');
        $progetto = Progetto::find(get_the_ID());

        if (! $progetto) {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include get_404_template();
            exit;
        }
        $this->render('single-progetto', [
            'progetto' => Progetto::find(get_the_ID()),
        ]);
    }
}
