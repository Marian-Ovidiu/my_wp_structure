<?php

use Core\App;

if (!function_exists('my_custom_options_page')) {
    function my_custom_options_page()
    {
        add_menu_page(
            'Impostazioni Generali',
            'Opzioni Generali',
            'manage_options',
            'opzioni-generali',
            'my_custom_options_page_html'
        );
    }
}

if (!function_exists('my_custom_options_page_html')) {
    function my_custom_options_page_html()
    {
        if (!current_user_can('manage_options')) {
            return;
        }
        echo App::blade()->make('optionPages.generals', [])->render();
    }
}

if (!function_exists('acf_location_rules_types')) {
    function acf_location_rules_types( $choices ) {
        $choices['Basic']['page'] = 'Pagina Opzioni';
        return $choices;
    }
}

if (!function_exists('acf_location_rule_values_page')) {
    function acf_location_rule_values_page( $choices ) {
        $choices['opzioni-generali'] = 'Opzioni Generali';
        return $choices;
    }
}

if (!function_exists('my_acf_location_options_page')) {
    function my_acf_location_options_page($match, $rule, $options) {
        if (isset($_GET['page']) && $_GET['page'] == 'opzioni-generali') {
            $match = true;
        }
        return $match;
    }
}