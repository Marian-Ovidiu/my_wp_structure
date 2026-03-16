<?php

namespace Features\WooCommerce;

class WooCommerceProvider
{
    public function register()
    {
        if (function_exists('custom_load_textdomain')) {
            add_action('plugins_loaded', 'custom_load_textdomain');
        }
        if (function_exists('disable_woocommerce_features')) {
            add_action('init', 'disable_woocommerce_features');
        }
        if (function_exists('tp_redirect')) {
            add_action('template_redirect', 'tp_redirect', 1);
        }
        if (function_exists('disable_woocommerce_pages')) {
            add_filter('woocommerce_get_page_id', 'disable_woocommerce_pages');
        }
    }
}
