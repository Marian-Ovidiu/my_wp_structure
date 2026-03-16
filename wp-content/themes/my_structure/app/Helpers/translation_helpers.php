<?php

if (!function_exists('theme_current_locale')) {
    function theme_current_locale($fallback = 'en')
    {
        if (function_exists('pll_current_language')) {
            $locale = pll_current_language('locale');
            if (is_string($locale) && $locale !== '') {
                return $locale;
            }

            $locale = pll_current_language();
            if (is_string($locale) && $locale !== '') {
                return $locale;
            }
        }

        if (function_exists('determine_locale')) {
            $locale = determine_locale();
            if (is_string($locale) && $locale !== '') {
                return $locale;
            }
        }

        if (function_exists('get_locale')) {
            $locale = get_locale();
            if (is_string($locale) && $locale !== '') {
                return $locale;
            }
        }

        return $fallback;
    }
}

if (!function_exists('theme_translate_string')) {
    function theme_translate_string($key, $locale = null, $fallbackLocale = 'en')
    {
        if (!is_string($key) || $key === '') {
            return '';
        }

        $langDir = get_template_directory() . '/resources/lang';
        $locale = is_string($locale) && $locale !== '' ? $locale : theme_current_locale($fallbackLocale);
        $fallbackLocale = is_string($fallbackLocale) && $fallbackLocale !== '' ? $fallbackLocale : 'en';

        $candidates = [];
        $candidates[] = $locale;
        if (strpos($locale, '_') !== false) {
            $candidates[] = substr($locale, 0, strpos($locale, '_'));
        }
        if (strpos($locale, '-') !== false) {
            $candidates[] = substr($locale, 0, strpos($locale, '-'));
        }
        if ($fallbackLocale) {
            $candidates[] = $fallbackLocale;
        }

        $translations = null;
        foreach (array_unique(array_filter($candidates)) as $candidate) {
            $jsonFile = $langDir . '/' . $candidate . '.json';
            if (!file_exists($jsonFile)) {
                continue;
            }

            $decoded = json_decode((string) file_get_contents($jsonFile), true);
            if (is_array($decoded)) {
                $translations = $decoded;
                break;
            }
        }

        if (!is_array($translations)) {
            return $key;
        }

        return array_key_exists($key, $translations) ? $translations[$key] : $key;
    }
}

if (!function_exists('load_static_strings')) {
    function load_static_strings($toTranslate)
    {
        return theme_translate_string($toTranslate);
    }
}
