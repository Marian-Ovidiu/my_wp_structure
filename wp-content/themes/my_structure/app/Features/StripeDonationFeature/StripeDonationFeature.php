<?php

namespace Features\StripeDonationFeature;

class StripeDonationFeature
{
    public function register()
    {
        $routesFile = get_template_directory() . '/source/routes/web.php';
        if (file_exists($routesFile)) {
            require_once $routesFile;
        }
    }
}
