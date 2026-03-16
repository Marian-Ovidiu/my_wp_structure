<?php

namespace Features\SitemapCleanupFeature;

class SitemapCleanupFeature
{
    public function register()
    {
        add_filter('wpseo_sitemap_entry', function ($url, $type, $object) {
            switch ($type) {
                case 'category':
                case 'author':
                    return false;
                default:
                    return $url;
            }
        }, 10, 3);
    }
}
