<?php

namespace Features\WooCommerceCleanupFeature;

class WooCommerceCleanupFeature
{
    public function register()
    {
        if (function_exists('disable_woocommerce_features')) {
            add_action('init', 'disable_woocommerce_features');
        }
        if (function_exists('tp_redirect')) {
            add_action('template_redirect', 'tp_redirect', 1);
        }
        if (function_exists('disable_woocommerce_pages')) {
            add_filter('woocommerce_get_page_id', 'disable_woocommerce_pages');
        }
        if (function_exists('disable_woocommerce_assets')) {
            add_action('after_setup_theme', 'disable_woocommerce_assets', 20);
        }
    }
}
