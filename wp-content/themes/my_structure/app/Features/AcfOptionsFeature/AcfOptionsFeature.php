<?php

namespace Features\AcfOptionsFeature;

use Core\App;

class AcfOptionsFeature
{
    private array $optionPages = [];

    public function register()
    {
        $this->optionPages = $this->loadOptionPages();
        if (empty($this->optionPages)) {
            return;
        }

        if (function_exists('acf_form_head')) {
            add_action('admin_head', 'acf_form_head');
        }

        add_action('admin_menu', [$this, 'registerOptionPages']);
        add_filter('acf/location/rule_types', [$this, 'registerLocationRuleType']);
        add_filter('acf/location/rule_values/theme_option_page', [$this, 'registerLocationRuleValues']);
        add_filter('acf/location/rule_match/theme_option_page', [$this, 'matchLocationRule'], 10, 3);

        // Backward compatibility: legacy setups used the "page" location rule for options pages.
        add_filter('acf/location/rule_values/page', [$this, 'registerLegacyLocationRuleValues']);
        add_filter('acf/location/rule_match/page', [$this, 'matchLegacyLocationRule'], 10, 3);
    }

    public function registerOptionPages(): void
    {
        foreach ($this->optionPages as $page) {
            $callback = function () use ($page) {
                $this->renderOptionPage($page);
            };

            if (!empty($page['parent_slug'])) {
                add_submenu_page(
                    $page['parent_slug'],
                    $page['page_title'],
                    $page['menu_title'],
                    $page['capability'],
                    $page['slug'],
                    $callback
                );
                continue;
            }

            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['slug'],
                $callback,
                $page['icon_url'],
                $page['position']
            );
        }
    }

    public function registerLocationRuleType(array $choices): array
    {
        $choices['Theme']['theme_option_page'] = __('Theme option page', 'my_structure');
        return $choices;
    }

    public function registerLocationRuleValues(array $choices): array
    {
        foreach ($this->optionPages as $page) {
            $choices[$page['slug']] = $page['menu_title'];
        }

        return $choices;
    }

    public function matchLocationRule($match, array $rule, array $options)
    {
        $currentPage = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
        if ($currentPage === '') {
            return $match;
        }

        if (($rule['operator'] ?? '==') === '==') {
            return $currentPage === ($rule['value'] ?? '');
        }

        if (($rule['operator'] ?? '') === '!=') {
            return $currentPage !== ($rule['value'] ?? '');
        }

        return $match;
    }

    public function registerLegacyLocationRuleValues(array $choices): array
    {
        foreach ($this->optionPages as $page) {
            $choices[$page['slug']] = $page['menu_title'];
        }

        return $choices;
    }

    public function matchLegacyLocationRule($match, array $rule, array $options)
    {
        $configuredSlugs = array_column($this->optionPages, 'slug');
        if (!in_array(($rule['value'] ?? ''), $configuredSlugs, true)) {
            return $match;
        }

        return $this->matchLocationRule($match, $rule, $options);
    }

    private function renderOptionPage(array $page): void
    {
        if (!current_user_can($page['capability'])) {
            return;
        }

        echo App::blade()->make($page['view'], [
            'optionPage' => $page,
            'fieldGroups' => $this->resolveFieldGroups($page['field_groups']),
            'postId' => $page['post_id'],
            'submitLabel' => $page['submit_label'],
        ])->render();
    }

    private function loadOptionPages(): array
    {
        $configFile = get_template_directory() . '/app/Config/options.php';
        if (!file_exists($configFile)) {
            return [];
        }

        $rawConfig = require $configFile;
        if (!is_array($rawConfig)) {
            return [];
        }

        $normalized = [];
        foreach ($rawConfig as $configItem) {
            if (!is_array($configItem)) {
                continue;
            }

            $page = $this->normalizeOptionPage($configItem);
            if ($page !== null) {
                $normalized[] = $page;
            }
        }

        return $normalized;
    }

    private function normalizeOptionPage(array $config): ?array
    {
        $slug = isset($config['slug']) ? sanitize_key((string) $config['slug']) : '';
        if ($slug === '') {
            return null;
        }

        $pageTitle = (string) ($config['page_title'] ?? $config['menu_title'] ?? ucfirst(str_replace('-', ' ', $slug)));
        $menuTitle = (string) ($config['menu_title'] ?? $pageTitle);

        return [
            'slug' => $slug,
            'page_title' => $pageTitle,
            'menu_title' => $menuTitle,
            'capability' => (string) ($config['capability'] ?? 'manage_options'),
            'parent_slug' => isset($config['parent_slug']) ? (string) $config['parent_slug'] : null,
            'icon_url' => isset($config['icon_url']) ? (string) $config['icon_url'] : '',
            'position' => isset($config['position']) ? (int) $config['position'] : null,
            'post_id' => (string) ($config['post_id'] ?? 'option'),
            'field_groups' => isset($config['field_groups']) && is_array($config['field_groups']) ? $config['field_groups'] : [],
            'view' => (string) ($config['view'] ?? 'optionPages.acf-options-page'),
            'submit_label' => (string) ($config['submit_label'] ?? __('Save settings', 'my_structure')),
        ];
    }

    private function resolveFieldGroups(array $fieldGroups): array
    {
        $resolved = [];

        foreach ($fieldGroups as $fieldGroup) {
            if (is_array($fieldGroup) && !empty($fieldGroup['key'])) {
                $resolved[] = (string) $fieldGroup['key'];
                continue;
            }

            if (!is_string($fieldGroup) || $fieldGroup === '') {
                continue;
            }

            if (str_starts_with($fieldGroup, 'group_')) {
                $resolved[] = $fieldGroup;
                continue;
            }

            if (!class_exists($fieldGroup) || !is_callable([$fieldGroup, 'get'])) {
                continue;
            }

            $instance = $fieldGroup::get();
            if (method_exists($instance, 'getGroupKey')) {
                $resolved[] = (string) $instance->getGroupKey();
            }
        }

        return array_values(array_unique($resolved));
    }
}
