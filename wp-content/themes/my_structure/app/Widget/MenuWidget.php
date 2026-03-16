<?php

namespace Widget;
use WP_Widget;
use Core\App;
class MenuWidget extends WP_Widget
{
    public function __construct() {
        parent::__construct(
            'menu_widget',
            __('Menu Widget', 'text_domain'),
            ['description' => __('A widget to display a menu', 'text_domain')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $menu_name = !empty($instance['menu_name']) ? camelToKebab($instance['menu_name']) : 'header-menu';
        $view_name = $this->resolveViewName($menu_name);
        $menu_items_raw = $this->resolveMenuItems($menu_name, $view_name);
        $menu_items = $this->buildMenuTree($menu_items_raw);
        if (!is_array($menu_items)) {
            $menu_items = [];
        }

        echo App::blade('view')->make('partials.'. $view_name, ['menu' => $menu_items])->render();
        echo $args['after_widget'];
    }

    private function resolveViewName(string $menuName): string
    {
        if (str_starts_with($menuName, 'header-menu')) {
            return 'header-menu';
        }

        if (str_starts_with($menuName, 'footer-menu')) {
            return 'footer-menu';
        }

        return $menuName;
    }

    private function resolveMenuItems(string $menuName, string $viewName)
    {
        $menuItems = wp_get_nav_menu_items($menuName);
        if ($menuItems !== false && !empty($menuItems)) {
            return $menuItems;
        }

        if ($viewName !== $menuName) {
            $fallbackItems = wp_get_nav_menu_items($viewName);
            if ($fallbackItems !== false) {
                return $fallbackItems;
            }
        }

        return is_array($menuItems) ? $menuItems : [];
    }

    private function buildMenuTree($items, $parent_id = 0) {
        $tree = [];
        foreach ($items as $item) {
            if ($item->menu_item_parent == $parent_id) {
                $children = $this->buildMenuTree($items, $item->ID);
                if (!empty($children)) {
                    $item->children = $children;
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }
}
