# Hardening Report

Date: 2026-03-16

## Fixed in this pass

- Router AJAX hook registration corrected:
  - Removed invalid global hooks (`wp_ajax_`, `wp_ajax_nopriv_` without action suffix).
  - AJAX actions are now registered per action name in `Router::ajax()`.
  - Added sanitization for action names and request values.
  - Added explicit 400 response for unknown AJAX actions.
  - File: `app/Core/Router.php`

- `addVarJs()` made robust:
  - Avoids fake enqueue without registration.
  - Registers an empty script handle only when needed, then localizes safely.
  - File: `app/Core/Bases/BaseController.php`

- `BasePostType` default/fallback hardening:
  - Removed hardcoded fallback language (`it`) when Polylang is not available.
  - `getDefaultImage()` now resolves a real existing placeholder from known paths:
    - `/public/images/placeholder.png`
    - `/source/assets/images/placeholder.png`
    - `/source/assets/images/placeholder.webp`
  - File: `app/Core/Bases/BasePostType.php`

- WooCommerce aggressive redirect removed:
  - Deleted `tp_redirect()` helper.
  - Removed all provider hooks to `tp_redirect`.
  - Removed stale `custom_load_textdomain` hook from WooCommerce provider.
  - Files:
    - `app/Features/WooCommerce/woocommerce_helpers.php`
    - `app/Features/WooCommerce/WooCommerceProvider.php`
    - `app/Features/WooCommerceCleanupFeature/WooCommerceCleanupFeature.php`

- PHP 8.x compatibility warning fixed:
  - `Singleton::__wakeup()` visibility changed to `public`.
  - File: `app/Core/Singleton.php`

- Translation helper fallback logic reviewed:
  - Existing ugly `$locale = $locale ?? 'it';` pattern is not present.
  - Added input guards for key/locale fallback normalization.
  - File: `app/Helpers/translation_helpers.php`

## Requested checks status

- Broken import in `ProgettoController`: `ProgettoController` does not exist anymore in the current codebase.
- Debug in `archive.php`: no debug/dump/die code found in current `archive.php`.
- Placeholder asset path: fixed in `BasePostType`.
- `addVarJs()` fake handle pattern: fixed.
- `tp_redirect` in core/features: removed from active feature code.

## Remaining fragile points

- Custom router runtime behavior still needs integration test inside a running WordPress instance:
  - Route matching currently uses exact `trim($uri, '/') === trim($wp->request, '/')`.
  - No parameterized routes currently supported.
  - Recommended: smoke-test custom routes + AJAX routes in local WP environment.

- `BaseController::addJs()` still references raw files in `source/assets/js/`:
  - This is valid for direct source loading, but not cache-optimal vs Vite-manifest strategy.
  - Consider a future unified asset loader policy (all dynamic JS via `vite_asset` entrypoints).

- Legacy/unused JS files remain in `source/assets/js/` (`progettoSlider.js`, `homeSlider.js`, etc.):
  - Not active in current Vite entrypoints, but still present.
  - Consider archiving/removing in a dedicated cleanup task.
