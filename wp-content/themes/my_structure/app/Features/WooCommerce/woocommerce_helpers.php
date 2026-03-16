<?php

if (!function_exists('disable_woocommerce_features')) {
    function disable_woocommerce_features()
    {
        // Disable non-essential WooCommerce editor supports.
        remove_post_type_support('product', 'title');
        remove_post_type_support('product', 'editor');
    }
}

if (!function_exists('disable_woocommerce_pages')) {
    function disable_woocommerce_pages($pageId, $page)
    {
        if (in_array($page, ['shop', 'cart', 'checkout', 'myaccount'], true)) {
            return false;
        }

        return $pageId;
    }
}

if (!function_exists('disable_woocommerce_assets')) {
    function disable_woocommerce_assets()
    {
        if (!class_exists('WooCommerce') || !function_exists('is_woocommerce')) {
            return;
        }

        add_action('wp_enqueue_scripts', function () {
            if (!is_woocommerce() && !is_cart() && !is_checkout()) {
                wp_dequeue_style('woocommerce-layout');
                wp_dequeue_style('woocommerce-general');
                wp_dequeue_style('woocommerce-smallscreen');

                wp_dequeue_script('wc-cart-fragments');
                wp_dequeue_script('woocommerce');
                wp_dequeue_script('wc-checkout');
                wp_dequeue_script('wc-add-to-cart');
            }
        }, 99);
    }
}
