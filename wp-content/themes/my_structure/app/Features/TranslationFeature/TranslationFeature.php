<?php

namespace Features\TranslationFeature;

class TranslationFeature
{
    public function register()
    {
        add_action('plugins_loaded', function () {
            $mo = get_template_directory() . '/languages/woocommerce-gateway-stripe-it_IT.mo';
            if (file_exists($mo)) {
                load_textdomain('woocommerce-gateway-stripe', $mo);
            }
        });
    }
}
