# Starter Theme Readiness Audit

Date: 2026-03-16  
Theme path: `wp-content/themes/my_structure`

## Scope

Audit goal: verify whether the current theme is project-agnostic and ready to be reused as a starter theme.

## Passed Checks

### 1) Core layer contains no nonprofit-specific logic or naming

Status: **PASS**

Findings:
- `app/Core/*` contains framework/bootstrap concerns (App init, Blade manager, router, base classes).
- No nonprofit/domain-specific terms or donation-specific rules were found in Core runtime code.

### 2) No legacy controllers are still required by templates or bootstrap

Status: **PASS**

Findings:
- Active template entrypoints (`front-page.php`, `page.php`, `archive.php`, `single.php`, `home.php`, `index.php`, `category.php`, `template-generic.php`) call only `Controllers\ExampleController`.
- Only one controller file exists in runtime controller namespace: `source/Controllers/ExampleController.php`.
- Bootstrap (`functions.php` + `app/Config/providers.php` + `app/Config/routes.php`) does not require legacy controllers.

### 3) No legacy Blade views are still part of active rendering flow

Status: **PASS**

Findings:
- Active render targets are generic/demo pages:
  - `resources/views/pages/home-demo.blade.php`
  - `resources/views/pages/generic-page.blade.php`
  - `resources/views/pages/generic-archive.blade.php`
  - `resources/views/pages/generic-single.blade.php`
- Layout/partials are generic:
  - `resources/views/layouts/mainLayout.blade.php`
  - `resources/views/partials/header-menu.blade.php`
  - `resources/views/partials/footer-menu.blade.php`
- `resources/views/optionPages/acf-options-page.blade.php` is present but only used when optional ACF options feature is enabled.

### 4) Optional features are truly optional and not loaded implicitly

Status: **PASS**

Findings:
- `app/Config/features.php` returns `[]`.
- `app/Config/feature-providers.php` returns `[]` (legacy compatibility file, currently empty).
- `App::registerFeatureProviders()` only registers classes listed in those config files.
- Feature modules in `app/Features/*` are not autoloaded as runtime side effects; they activate only when configured.

## Failed Checks

### 5) Theme can run with only one example controller, one example Blade page, one generic layout, one generic header/footer, and asset pipeline

Status: **FAIL (partially met)**

What is already met:
- One example controller class exists (`source/Controllers/ExampleController.php`).
- One generic layout exists (`resources/views/layouts/mainLayout.blade.php`).
- Generic header/footer partials exist (`resources/views/partials/header-menu.blade.php`, `resources/views/partials/footer-menu.blade.php`).
- Asset pipeline is wired (`vite.config.js`, `source/assets/*`, `public/.vite/manifest.json`, `vite_asset()` helper).

Why it fails:
- Active runtime requires multiple controller methods and multiple Blade page templates:
  - Controller methods in use: `home`, `page`, `archive`, `single`
  - Blade pages in use: `home-demo`, `generic-page`, `generic-archive`, `generic-single`
- Current template entry files do not collapse to a single example page flow.

## Files Still Coupled To Legacy Project Logic

- `wp-content/themes/my_structure/.env`
  - Contains Stripe webhook keys (`STRIPE_WEBHOOK_SECRET*`), which are legacy project-specific and should not live in starter theme source control.
- `wp-content/themes/my_structure/app/Core/App.php`
  - Contains backward-compatibility loading for `app/Config/feature-providers.php`; this is legacy-structure coupling (not nonprofit logic, but legacy migration coupling).
- `wp-content/themes/my_structure/app/Config/feature-providers.php`
  - Legacy compatibility config file retained alongside `features.php`.
- `wp-content/themes/my_structure/header.php`
  - Legacy Twenty Seventeen header comment block remains (inactive in current Blade-driven rendering, but still legacy residue).

## Exact Actions Needed To Finish Extraction

1. Reduce runtime to one page render path:
- Keep one controller method (for example `ExampleController::page()`), and point all active template entrypoints to that same method.
- Keep one Blade page (for example `resources/views/pages/generic-page.blade.php`) and remove/archive the extra active page templates once entrypoints are updated.

2. Remove legacy feature-config compatibility:
- Stop loading `app/Config/feature-providers.php` in `app/Core/App.php`.
- Keep only `app/Config/features.php` as the single feature toggle source.
- Delete `app/Config/feature-providers.php` after reference removal.

3. Remove project secrets and donation-era environment coupling:
- Remove `.env` from repository history/tracked files for the theme.
- Add `.env.example` with neutral placeholders only.
- Rotate any leaked Stripe secrets.

4. Finalize neutral template surface:
- Replace or remove legacy `header.php` stub comments (or make it a minimal neutral fallback).
- Keep Blade layout + header/footer partials as the canonical rendering path.

5. Normalize starter identity (recommended for reusable distribution):
- Replace theme/package identifiers (`my_structure`) with starter-neutral placeholders in:
  - `style.css` (Theme Name/Text Domain)
  - `composer.json` package name
  - `package.json` package name
- Regenerate build and verify WordPress loads without feature modules enabled.
