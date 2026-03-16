# Legacy Coupling Removal

Date: 2026-03-16  
Scope: `wp-content/themes/my_structure`

## Removed Couplings

1. Legacy feature-provider compatibility path removed from runtime bootstrap
- Removed file: `wp-content/themes/my_structure/app/Config/feature-providers.php`
- Updated file: `wp-content/themes/my_structure/app/Core/App.php`
- Change: `App::registerFeatureProviders()` now reads only `app/Config/features.php`.
- Runtime impact: the starter theme no longer depends on legacy dual-config feature loading.

2. Legacy project secrets removed from tracked theme files
- Removed file: `wp-content/themes/my_structure/.env`
- Added file: `wp-content/themes/my_structure/.env.example`
- Updated file: `.gitignore` (ignore `wp-content/themes/my_structure/.env`, allow `.env.example`)
- Runtime impact: no nonprofit/Stripe production credentials are required from source-controlled theme files.

3. Legacy fallback template residue removed
- Updated file: `wp-content/themes/my_structure/header.php`
- Updated file: `wp-content/themes/my_structure/footer.php`
- Change: replaced legacy stub/empty files with neutral WordPress fallback templates.
- Runtime impact: if classic `get_header()` / `get_footer()` paths are used, output remains valid and project-agnostic.

## Isolated Couplings (Not Loaded By Default)

1. Option-page and feature modules remain isolated behind explicit feature toggles
- `wp-content/themes/my_structure/app/Config/features.php` remains empty (`return [];`).
- `app/Features/*` code is available but not loaded unless a class is explicitly added to `features.php`.
- `app/Config/options.php` remains empty (`return [];`), so no project option-page behavior is active.
- This includes legacy ACF-location backward-compatibility methods in `app/Features/AcfOptionsFeature/AcfOptionsFeature.php`, which are now isolated from runtime unless the feature is explicitly enabled.

2. Route integrations remain isolated
- `wp-content/themes/my_structure/app/Config/routes.php` remains empty (`return [];`).
- No project route helpers are loaded at runtime.

## Verification

- PHP syntax checks passed:
  - `php -l wp-content/themes/my_structure/app/Core/App.php`
  - `php -l wp-content/themes/my_structure/header.php`
  - `php -l wp-content/themes/my_structure/footer.php`
- Repository-wide checks for legacy coupling strings in theme runtime returned no matches for:
  - `feature-providers.php`
  - `STRIPE_`, `sk_live`, `pk_live`
