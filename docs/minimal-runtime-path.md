# Minimal Runtime Path

Date: 2026-03-16  
Theme path: `wp-content/themes/my_structure`

## Goal

Provide a minimal, project-agnostic runtime path that renders a demo page with:
- one `ExampleController`
- one demo Blade page
- one generic layout
- one generic header
- one generic footer
- no business-specific dependencies enabled at runtime

## Active Runtime Chain

1. WordPress bootstrap
- `functions.php` -> `Core\App::getInstance()->init()`

2. Core initialization
- `app/Core/App.php` registers only:
  - `after_setup_theme` -> `my_theme_setup`
- Optional feature modules are read only from `app/Config/features.php` (currently empty).

3. Template entrypoints
- All active template files route to the same action:
  - `front-page.php`
  - `index.php`
  - `home.php`
  - `page.php`
  - `single.php`
  - `archive.php`
  - `category.php`
  - `template-generic.php`
- Each now calls: `\Controllers\ExampleController::call('demo');`

4. Controller
- Single controller file: `source/Controllers/ExampleController.php`
- Single action method: `demo()`
- Render target: `pages.demo`

5. Blade rendering
- Demo page: `resources/views/pages/demo.blade.php`
- Layout: `resources/views/layouts/generic-layout.blade.php`
- Header partial: `resources/views/partials/generic-header.blade.php`
- Footer partial: `resources/views/partials/generic-footer.blade.php`

6. Asset pipeline
- Assets still loaded by generic helper hooks:
  - CSS: `vite_asset('scss/style.scss')`
  - JS: `vite_asset('js/main.js')`

## Legacy/Business Coupling Removed From Active Path

- Controller actions removed from active runtime: `home`, `page`, `archive`, `single`.
- Legacy active Blade pages removed:
  - `resources/views/pages/home-demo.blade.php`
  - `resources/views/pages/generic-page.blade.php`
  - `resources/views/pages/generic-archive.blade.php`
  - `resources/views/pages/generic-single.blade.php`
- Legacy layout removed:
  - `resources/views/layouts/mainLayout.blade.php`
- Legacy menu-widget-driven header/footer partials removed from active rendering:
  - `resources/views/partials/header-menu.blade.php`
  - `resources/views/partials/footer-menu.blade.php`
- Optional feature and route loading remains disabled by default:
  - `app/Config/features.php` -> `return [];`
  - `app/Config/routes.php` -> `return [];`

## Verification

1. Controller/action verification
- Search result confirms only one method in `ExampleController`: `demo()`.
- Search result confirms all template entrypoints call `ExampleController::call('demo')`.

2. Blade path verification
- Search result confirms page view extends only `layouts.generic-layout`.

3. Feature isolation verification
- `app/Config/features.php` is empty (`return [];`), so no nonprofit/legacy feature provider is loaded.
- `app/Config/routes.php` is empty (`return [];`), so no project route file is loaded.

4. PHP syntax verification
- `php -l` passed for:
  - `source/Controllers/ExampleController.php`
  - `front-page.php`, `index.php`, `home.php`, `page.php`, `single.php`, `archive.php`, `category.php`, `template-generic.php`
  - `app/Core/App.php`

## Notes

- This verification is code-path verification plus syntax checks.
- A browser-level WordPress smoke test (theme activation + page request) was not executed in this step.
