<?php

namespace Features\TranslationFeature;

class TranslationFeature
{
    public function register()
    {
        add_action('after_setup_theme', function () {
            load_theme_textdomain('my_structure', get_template_directory() . '/languages');
        });
    }
}
