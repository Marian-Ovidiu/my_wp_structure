<?php

namespace Controllers;

use Core\Bases\BaseController;

class PageController extends BaseController {
    public function test()
    {
        $available_gateways = WC()->payment_gateways->get_available_payment_gateways();

        $this->addJs('stripe', 'https://js.stripe.com/v3/', [], true);
        $this->addJs('donation', 'donation.js', ['stripe'], true);
        $this->render('forms', ['pagamenti_disponibili' => $available_gateways]);
    }
}
