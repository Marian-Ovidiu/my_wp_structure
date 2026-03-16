<?php

use Dotenv\Dotenv;

if (!function_exists('vite_asset')) {
    function vite_asset($path)
    {
        static $manifestCache = null;

        $manifestPath = get_template_directory() . '/public/.vite/manifest.json';
        if ($manifestCache === null) {
            $manifestCache = [];
            if (file_exists($manifestPath)) {
                $decoded = json_decode((string) file_get_contents($manifestPath), true);
                if (is_array($decoded)) {
                    $manifestCache = $decoded;
                } else {
                    error_log('Invalid Vite manifest JSON: ' . $manifestPath);
                }
            } else {
                error_log('Vite manifest not found: ' . $manifestPath);
            }
        }

        $key = 'assets/' . ltrim((string) $path, '/');
        if (isset($manifestCache[$key]['file'])) {
            return get_template_directory_uri() . '/public/' . $manifestCache[$key]['file'];
        }

        error_log('Asset not found in Vite manifest: ' . $key);
        return null;
    }
}

if (!function_exists('camelToKebab')) {
    function camelToKebab($string)
    {
        return strtolower((string) preg_replace('/(?<!^)([A-Z])/', '-$1', (string) $string));
    }
}

if (!function_exists('my_env')) {
    function my_env($key, $default = null)
    {
        static $loaded = false;

        if (!$loaded) {
            $envPath = dirname(__DIR__, 2);
            $envFile = $envPath . '/.env';
            if (file_exists($envFile)) {
                try {
                    Dotenv::createImmutable($envPath)->safeLoad();
                } catch (\Throwable $e) {
                    error_log('Unable to load .env file: ' . $e->getMessage());
                }
            }
            $loaded = true;
        }

        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return $value;
    }
}

if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        return get_template_directory() . '/resources/' . ltrim((string) $path, '/');
    }
}

if (!function_exists('base_path')) {
    function base_path($path = '')
    {
        return get_template_directory() . '/' . ltrim((string) $path, '/');
    }
}

if (!function_exists('config')) {
    function config($key, $default = null)
    {
        $file = get_template_directory() . '/app/Config/' . $key . '.php';
        if (!file_exists($file)) {
            return $default;
        }

        $config = require $file;
        return is_array($config) ? $config : $default;
    }
}
