<?php

if (!function_exists('my_theme_setup')) {
    function my_theme_setup() {
        add_base_js();
        add_base_css();
        register_menus();
    }
}

if (!function_exists('add_base_css')) {
    function add_base_css() {
        add_action('wp_enqueue_scripts', function() {
            $fullSrcStyle = vite_asset('scss/style.scss');
            wp_enqueue_style('style', $fullSrcStyle);
        });
    }
}

if (!function_exists('add_base_js')) {
    function add_base_js() {
        $fullSrc = vite_asset('js/main.js');
        add_action('wp_enqueue_scripts', function () use($fullSrc) {
            wp_enqueue_script('main', $fullSrc, ['jquery'], null, true);
            wp_script_add_data('main', 'data-iub-consent', 'necessary');
        });
    }
}

if (!function_exists('register_my_widgets')) {
    function register_my_widgets() {
        register_widget('Widget\MenuWidget');
    }
}

if (!function_exists('register_menus')) {
    function register_menus()
    {
        add_theme_support('menus');
        $menus = include get_template_directory() . '/app/Config/menus.php';
        register_nav_menus($menus);
    }
}

if (!function_exists('theme_option_field_first')) {
    function theme_option_field_first(array $keys)
    {
        if (!function_exists('get_field')) {
            return null;
        }

        foreach ($keys as $key) {
            $value = get_field($key, 'option');
            if ($value !== null && $value !== '' && $value !== []) {
                return $value;
            }
        }

        return null;
    }
}

if (!function_exists('get_theme_branding')) {
    function get_theme_branding(): array
    {
        $title = theme_option_field_first(['theme_title', 'site_title']);
        $subtitle = theme_option_field_first(['theme_subtitle', 'site_subtitle']);
        $logo = theme_option_field_first(['theme_logo', 'site_logo', 'logo']);

        $logoUrl = '';
        $logoAlt = '';
        if (is_array($logo)) {
            $logoUrl = $logo['url'] ?? '';
            $logoAlt = $logo['alt'] ?? '';
        } elseif (is_numeric($logo)) {
            $logoId = (int) $logo;
            $logoUrl = wp_get_attachment_image_url($logoId, 'full') ?: '';
            $logoAlt = (string) get_post_meta($logoId, '_wp_attachment_image_alt', true);
        } elseif (is_string($logo)) {
            $logoUrl = $logo;
        }

        if (!$logoUrl && has_custom_logo()) {
            $logoId = (int) get_theme_mod('custom_logo');
            $logoUrl = wp_get_attachment_image_url($logoId, 'full') ?: '';
            $logoAlt = (string) get_post_meta($logoId, '_wp_attachment_image_alt', true);
        }

        $siteName = $title ?: get_bloginfo('name');

        return [
            'home_url' => home_url('/'),
            'title' => $siteName,
            'subtitle' => $subtitle ?: get_bloginfo('description'),
            'logo_url' => $logoUrl,
            'logo_alt' => $logoAlt ?: $siteName,
        ];
    }
}

