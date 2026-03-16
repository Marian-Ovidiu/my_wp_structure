<?php

namespace Core\Bases;

use Core\App;

abstract class BaseController
{
    public function __construct()
    {
    }

    public static function call($method, $params = [])
    {
        $instance = new static();
        if (method_exists($instance, $method)) {
            call_user_func_array([$instance, $method], $params);
            return;
        }

        throw new \Exception("Method $method not found in " . static::class);
    }

    protected function addCss($handle, $src, $deps = [], $ver = false)
    {
        if (filter_var($src, FILTER_VALIDATE_URL) && preg_match('/^https?:\/\//', $src)) {
            $fullSrc = $src;
        } else {
            $fullSrc = get_template_directory_uri() . '/source/assets/css/' . ltrim($src, '/');
        }

        wp_enqueue_style($handle, $fullSrc, $deps, $ver);
    }

    protected function addJs($handle, $src, $deps = [], $in_footer = false, $ver = false)
    {
        if (filter_var($src, FILTER_VALIDATE_URL) && preg_match('/^https?:\/\//', $src)) {
            $fullSrc = $src;
        } else {
            $relativePath = '/source/assets/js/' . ltrim($src, '/');
            $fullSrc = get_template_directory_uri() . $relativePath;
            if (!$ver) {
                $filePath = get_template_directory() . $relativePath;
                if (file_exists($filePath)) {
                    $ver = filemtime($filePath);
                }
            }
        }

        add_action('wp_enqueue_scripts', function () use ($handle, $fullSrc, $deps, $ver, $in_footer) {
            wp_enqueue_script($handle, $fullSrc, $deps, $ver, $in_footer);
        });
    }

    protected function addVarJs($handle, $varName, $data, $inFooter = false, $ver = false)
    {
        add_action('wp_enqueue_scripts', function () use ($handle, $varName, $data, $ver, $inFooter) {
            if (!wp_script_is($handle, 'registered') && !wp_script_is($handle, 'enqueued')) {
                wp_register_script($handle, '', [], $ver, $inFooter);
            }

            wp_enqueue_script($handle);
            wp_localize_script($handle, $varName, $data);
        });
    }

    protected function render($view, $data = [])
    {
        echo App::blade()->make($view, $data)->render();
    }
}
