# Dependency Audit (Core Starter Theme)

Date: 2026-03-16

## Scope

Audit of PHP (`composer.json`) and JS (`package.json`) dependencies after charity/donation cleanup, with goal of keeping only what is needed by the reusable starter theme core.

## Removed Dependencies

### PHP

- `illuminate/database`
  - Not used by current core/theme runtime.
  - No `Illuminate\Database` usage in `app/` or `source/`.
- `symfony/var-dumper`
  - Not used in core/theme code.
  - Removed as direct dependency; no debug-only requirement for starter baseline.
- `phpoption/phpoption`
  - No direct usage in project code.
  - Remains available transitively via `vlucas/phpdotenv` when needed.

### JS

- `chart.js`
  - No active import in current Vite entrypoints (`source/assets/js/main.js` + `source/assets/scss/style.scss`).
- `swiper`
  - No active import in current Vite entrypoints.
  - Legacy slider files remain in repo but are not bundled by default.

## Adjustments

- Moved `vite` from `dependencies` to `devDependencies` (build-time tool, not runtime dependency).

## Dependencies Kept (and Why)

### PHP

- `illuminate/view`, `illuminate/container`, `illuminate/contracts`, `illuminate/events`, `illuminate/filesystem`
  - Required by Blade integration (`app/Core/BladeManager.php`).
- `illuminate/collections`, `illuminate/support`, `illuminate/macroable`
  - Required by Laravel helper/runtime features used by Blade/templates.
- `respect/validation`
  - Used by validation base classes (`app/Core/Validator.php`, `app/Core/Bases/BaseValidator.php`).
- `vlucas/phpdotenv`
  - Used by environment loader helper (`app/Helpers/utility_helpers.php`).

### JS

- `alpinejs`, `@alpinejs/intersect`
  - Used in global frontend bootstrap (`source/assets/js/main.js`).
- `axios`
  - Used in `main.js` and `source/assets/js/Classes/ApiService.js`.
- Tailwind/PostCSS/Sass toolchain (`tailwindcss`, `@tailwindcss/forms`, `tailwind-scrollbar`, `postcss`, `autoprefixer`, `sass`)
  - Required by current style pipeline.

## Lockfile / Verification

- Updated `composer.lock` via:
  - `composer update --no-install`
- Updated `package-lock.json` via:
  - `npm install --package-lock-only`
- Build verification:
  - `npm run build` succeeds with current dependency set.

## Notes

- `stripe/stripe-php` and Stripe npm package are not present in current manifests.
- If legacy slider/chart scripts become active entrypoints later, re-add only the specific package needed.
