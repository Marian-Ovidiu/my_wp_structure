<?php

namespace Core;

class RouterProvider
{
    public function register()
    {
        $routesFile = get_template_directory() . '/app/Config/routes.php';
        $fileRoutes = [];
        if (file_exists($routesFile)) {
            $fileRoutes = require $routesFile;
        }

        foreach ($fileRoutes as $helper) {
            $file = get_template_directory() . '/' . $helper;
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
}
