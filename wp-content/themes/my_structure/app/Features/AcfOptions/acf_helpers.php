<?php

use Core\App;

if (!function_exists('my_custom_options_page')) {
    function my_custom_options_page()
    {
        add_menu_page(
            'Theme Options',
            'Theme Options',
            'manage_options',
            'theme-options',
            function (){
                my_custom_options_page_html();
            }
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
        $choices['theme-options'] = 'Theme Options';
        return $choices;
    }
}

if (!function_exists('my_acf_location_options_page')) {
    function my_acf_location_options_page($match, $rule, $options) {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'theme-options':
                    $match = true;
                    break;
                default:
                    break;
            }
        }
        return $match;
    }
}
