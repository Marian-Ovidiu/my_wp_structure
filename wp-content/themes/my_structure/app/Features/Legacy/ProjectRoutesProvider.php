<?php

namespace Features\Legacy;

class ProjectRoutesProvider
{
    public function register()
    {
        $file = get_template_directory() . '/source/routes/web.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
