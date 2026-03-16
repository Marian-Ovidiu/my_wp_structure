<?php
namespace Core;

class App extends Init
{
    public function init()
    {
        parent::init();
        $this->registerProviders();
        $this->registerFeatureProviders();
    }

    public function registerHook()
    {
        add_action('after_setup_theme', 'my_theme_setup');
        add_action('widgets_init', 'register_my_widgets');
    }

    public function registerProviders()
    {
        $providers = require get_template_directory() . '/app/Config/providers.php';
        foreach ($providers as $provider) {
            if (class_exists($provider)) {
                (new $provider())->register();
            }
        }
    }

    public function registerFeatureProviders()
    {
        $providers = [];
        $featuresFile = get_template_directory() . '/app/Config/features.php';
        if (file_exists($featuresFile)) {
            $providers = require $featuresFile;
        }

        // Backward-compatibility with older feature provider config.
        $legacyFile = get_template_directory() . '/app/Config/feature-providers.php';
        if (file_exists($legacyFile)) {
            $providers = array_merge($providers, require $legacyFile);
        }

        foreach ($providers as $provider) {
            if (class_exists($provider)) {
                (new $provider())->register();
            }
        }
    }
}
