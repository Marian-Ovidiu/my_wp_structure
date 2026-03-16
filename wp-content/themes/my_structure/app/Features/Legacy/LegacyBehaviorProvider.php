<?php

namespace Features\Legacy;

class LegacyBehaviorProvider
{
    public function register()
    {
        if (function_exists('exclude_page_from_sitemap')) {
            add_filter('wpseo_sitemap_entry', 'exclude_page_from_sitemap', 10, 3);
        }
    }
}
