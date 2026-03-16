<?php

namespace Features\AcfOptionsFeature;

class AcfOptionsFeature
{
    public function register()
    {
        if (function_exists('my_custom_options_page')) {
            add_action('admin_menu', 'my_custom_options_page');
        }
        if (function_exists('acf_form_head')) {
            add_action('admin_head', 'acf_form_head');
        }
        if (function_exists('acf_location_rules_types')) {
            add_filter('acf/location/rule_types', 'acf_location_rules_types');
        }
        if (function_exists('acf_location_rule_values_page')) {
            add_filter('acf/location/rule_values/page', 'acf_location_rule_values_page');
        }
        if (function_exists('my_acf_location_options_page')) {
            add_filter('acf/location/rule_match/page', 'my_acf_location_options_page', 10, 3);
        }
    }
}
