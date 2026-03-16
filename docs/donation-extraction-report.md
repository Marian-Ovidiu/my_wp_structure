# Donation/Stripe Extraction Report

## Scope

This refactor removes donation/Stripe functionality from the base theme so the framework remains clean and project-agnostic.

## Removed Files

- `wp-content/themes/my_structure/source/Classes/StripePayments.php`
- `wp-content/themes/my_structure/source/Classes/GrazieEmail.php`
- `wp-content/themes/my_structure/source/routes/web.php`
- `wp-content/themes/my_structure/source/assets/js/donation.js`
- `wp-content/themes/my_structure/source/assets/js/single-donation.js`
- `wp-content/themes/my_structure/app/Features/StripeDonationFeature/StripeDonationFeature.php`
- `wp-content/themes/my_structure/app/Features/Legacy/ProjectRoutesProvider.php`
- `wp-content/themes/my_structure/resources/views/forms.blade.php`

## Modified Files

- `wp-content/themes/my_structure/source/Controllers/PageController.php`
  - Removed Stripe script enqueue and donation flow wiring.
  - Removed gateway collection and `pagamenti_disponibili` payload.
- `wp-content/themes/my_structure/source/Controllers/ProgettoController.php`
  - Removed Stripe script enqueue and donation flow wiring.
  - Removed gateway collection and `pagamenti_disponibili` payload.
  - Fixed invalid import statement for `OpzioniArchivioProgettoFields`.
- `wp-content/themes/my_structure/resources/views/pages/archivio-progetto.blade.php`
  - Replaced donation form UI with neutral non-donation CTA card.
- `wp-content/themes/my_structure/resources/views/pages/single-progetto.blade.php`
  - Replaced donation form UI with neutral non-donation CTA card.
- `wp-content/themes/my_structure/app/Features/TranslationFeature/TranslationFeature.php`
  - Removed Stripe gateway-specific textdomain bootstrap.
  - Switched to generic theme textdomain loading.
- `wp-content/themes/my_structure/app/Config/features.php`
  - Removed Stripe feature reference from config examples.
- `wp-content/themes/my_structure/app/Config/feature-providers.php`
  - Removed Stripe feature reference from config examples.
- `wp-content/themes/my_structure/composer.json`
  - Removed `stripe/stripe-php`.
  - Removed unused PSR-4 autoload mappings for removed source areas.
- `wp-content/themes/my_structure/composer.lock`
  - Regenerated; Stripe package removed.
- `wp-content/themes/my_structure/package.json`
  - Removed `stripe` npm dependency.
- `wp-content/themes/my_structure/package-lock.json`
  - Regenerated without Stripe dependency.

## Verification

- Static search confirms removal of:
  - `/create-payment-intent`
  - `/complete-donation`
  - `StripePayments`, `GrazieEmail`
  - `donationFormData`
  - `donation.js` / `single-donation.js` references
  - Stripe class/API references in source theme code
- PHP syntax checks passed for touched PHP controllers/config/feature files.
- Dependency lockfiles were updated:
  - `composer update`
  - `npm install --package-lock-only`

## Notes

- `composer update` also upgraded multiple transitive packages while removing Stripe.
- Prebuilt assets under `public/` were not regenerated in this step.
