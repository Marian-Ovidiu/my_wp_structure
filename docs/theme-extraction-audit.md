# Theme Extraction Audit

## Obiettivo

Classificare il tema custom in 3 gruppi:

1. Core/framework riutilizzabile
2. Moduli opzionali (attivabili quando servono)
3. Codice specifico del progetto charity legacy

Questo documento è un audit statico: **nessuna modifica invasiva applicata**.

## Criteri di classificazione

- **Core/framework riutilizzabile**: bootstrap generico, astrazioni base, integrazione Blade, utility non di dominio.
- **Moduli opzionali**: integrazioni plugin/servizi (WooCommerce, Stripe, option pages ACF) estraibili in feature togglable.
- **Project charity**: template, controller, model ACF, contenuti, asset e flussi legati al progetto no-profit.

## Mappa file-per-file

### 1) Core/framework riutilizzabile

- `functions.php`
- `composer.json`
- `composer.lock`
- `package.json`
- `package-lock.json`
- `postcss.config.js`
- `tailwind.config.js`
- `vite.config.js`
- `style.css`
- `app/Config/laravel-translatable-string-exporter.php`
- `app/Config/menus.php`
- `app/Config/providers.php`
- `app/Core/App.php` *(core contaminato da hook feature/project, da ripulire)*
- `app/Core/BladeManager.php`
- `app/Core/FieldAcf.php`
- `app/Core/Init.php`
- `app/Core/Router.php`
- `app/Core/RouterProvider.php` *(core contaminato da path route progetto)*
- `app/Core/Singleton.php`
- `app/Core/Validator.php`
- `app/Core/Bases/BaseController.php` *(core contaminato da path asset progetto)*
- `app/Core/Bases/BaseGroupAcf.php`
- `app/Core/Bases/BasePostType.php`
- `app/Core/Bases/BaseValidator.php`
- `app/Helpers/theme_helpers.php` *(support layer, oggi contiene anche decisioni di progetto)*
- `app/Helpers/translation_helpers.php`
- `app/Helpers/utility_helpers.php`
- `app/Scripts/export-translations.php`
- `app/Widget/MenuWidget.php` *(riutilizzabile con naming menu parametrico)*

### 2) Moduli opzionali (integrazioni)

- `app/Helpers/acf_helpers.php` *(option pages ACF custom + location rules)*
- `app/Helpers/woocommerce_helpers.php` *(cleanup/disabilitazioni WooCommerce)*
- `source/routes/web.php` *(route payment intent / complete donation)*
- `source/Classes/StripePayments.php` *(integrazione Stripe, oggi con logica charity embedded)*
- `source/Classes/GrazieEmail.php` *(mailer donazione, branding charity hardcoded)*
- `source/assets/js/donation.js`
- `source/assets/js/single-donation.js`

### 3) Codice specifico progetto charity (legacy)

- `.env`
- `archive-progetto.php`
- `archive.php`
- `category.php`
- `footer.php`
- `header.php`
- `home.php`
- `index.php`
- `single-progetto.php`
- `single.php`
- `template-aziende.php`
- `template-galleria.php`
- `template-grazie.php`
- `template-home.php`
- `template-progetti.php`
- `public/.vite/manifest.json`
- `public/css/main-DV8PrLMj.css`
- `public/css/style-BgijcD8r.css`
- `public/js/main-BUyRlVI7.js`
- `resources/lang/de.json`
- `resources/lang/en.json`
- `resources/lang/en_US.json`
- `resources/lang/fr.json`
- `resources/lang/it.json`
- `resources/views/admin-front.blade.php`
- `resources/views/archivio-post.blade.php`
- `resources/views/archivio-progetto.blade.php`
- `resources/views/aziende.blade.php`
- `resources/views/forms.blade.php`
- `resources/views/galleria.blade.php`
- `resources/views/grazie.blade.php`
- `resources/views/home.blade.php`
- `resources/views/single-progetto.blade.php`
- `resources/views/singolo-post.blade.php`
- `resources/views/components/aziende.blade.php`
- `resources/views/components/chart.blade.php`
- `resources/views/components/duo-logo.blade.php`
- `resources/views/components/home-cards.blade.php`
- `resources/views/components/home-mobile-cards.blade.php`
- `resources/views/components/img.blade.php`
- `resources/views/components/linear-slider.blade.php`
- `resources/views/components/missione.blade.php`
- `resources/views/components/mono-logo.blade.php`
- `resources/views/components/section.blade.php`
- `resources/views/components/slider.blade.php`
- `resources/views/components/testo-sottotesto.blade.php`
- `resources/views/layouts/mainLayout.blade.php`
- `resources/views/optionPages/archivioOpzioniProgetto.blade.php`
- `resources/views/optionPages/generals.blade.php`
- `resources/views/partials/footer-menu-deutsch.blade.php`
- `resources/views/partials/footer-menu-english.blade.php`
- `resources/views/partials/footer-menu-francais.blade.php`
- `resources/views/partials/footer-menu.blade.php`
- `resources/views/partials/header-menu-deutsch.blade.php`
- `resources/views/partials/header-menu-english.blade.php`
- `resources/views/partials/header-menu-francais.blade.php`
- `resources/views/partials/header-menu.blade.php`
- `resources/views/partials/language-menu.blade.php`
- `resources/views/svg/charity-dark.blade.php`
- `resources/views/svg/charity.blade.php`
- `resources/views/svg/contact.blade.php`
- `resources/views/svg/gallery.blade.php`
- `resources/views/svg/logo-placeholder-1.blade.php`
- `resources/views/svg/logo-placeholder-2.blade.php`
- `resources/views/svg/logo-placeholder-3.blade.php`
- `resources/views/svg/logo-placeholder-4.blade.php`
- `resources/views/svg/logo-placeholder-5.blade.php`
- `source/assets/css/homeSlider.css`
- `source/assets/css/overlap.css`
- `source/assets/css/style.css`
- `source/assets/fonts/Nunito-Bold.ttf`
- `source/assets/fonts/Nunito-Bold.woff`
- `source/assets/fonts/Nunito-Bold.woff2`
- `source/assets/fonts/Nunito-Regular.ttf`
- `source/assets/fonts/Nunito-Regular.woff`
- `source/assets/fonts/Nunito-Regular.woff2`
- `source/assets/fonts/NunitoSans-Light.ttf`
- `source/assets/fonts/NunitoSans-Light.woff`
- `source/assets/fonts/NunitoSans-Light.woff2`
- `source/assets/fonts/NunitoSans-Regular.ttf`
- `source/assets/fonts/NunitoSans-Regular.woff`
- `source/assets/fonts/NunitoSans-Regular.woff2`
- `source/assets/images/pittogramma.png`
- `source/assets/images/pittogramma.webp`
- `source/assets/images/placeholder.png`
- `source/assets/images/placeholder.png.webp`
- `source/assets/js/Chart.js`
- `source/assets/js/highlight.js`
- `source/assets/js/homeSlider.js`
- `source/assets/js/homeTestAjax.js`
- `source/assets/js/main.js`
- `source/assets/js/progettoSlider.js`
- `source/assets/js/Classes/ApiService.js`
- `source/assets/scss/fonts.scss`
- `source/assets/scss/style.scss`
- `source/Controllers/HomeController.php`
- `source/Controllers/PageController.php`
- `source/Controllers/PostController.php`
- `source/Controllers/ProgettoController.php`
- `source/Models/AziendeFields.php`
- `source/Models/DuoFields.php`
- `source/Models/GalleriaFields.php`
- `source/Models/Grazie.php`
- `source/Models/HomeFields.php`
- `source/Models/LinearSlider.php`
- `source/Models/MonoFields.php`
- `source/Models/Progetti.php`
- `source/Models/Progetto.php`
- `source/Models/Options/OpzioniArchivioProgettoFields.php`
- `source/Models/Options/OpzioniGlobaliFields.php`

## Dipendenze incrociate Core <-> Project (principali)

| Punto di accoppiamento | Evidenza | Impatto |
|---|---|---|
| Core bootstrap chiama callback feature/project | `app/Core/App.php` linee 16-31 (`add_action`/`add_filter` verso helper Woo/ACF/theme) | Il Core non è neutro: attiva comportamenti business/integrazione. |
| Core provider carica route progetto | `app/Core/RouterProvider.php` linea 8 (`source/routes/web.php`) | Router core dipende da file legacy `source/`. |
| BaseController punta a path asset progetto | `app/Core/Bases/BaseController.php` linee 26 e 36 (`/source/assets/...`) | Accoppiamento forte tra base astratta e struttura asset specifica. |
| Template WP chiamano controller progetto direttamente | `template-*.php`, `archive*.php`, `single*.php`, `home.php` (namespace `Controllers\...`) | Rendering WP dipende da controller legacy. |
| Helper ACF usa Blade view di option pages progetto | `app/Helpers/acf_helpers.php` linee 38-41 (`optionPages.*`) | Option pages non modularizzate: dipendenza tra helper globale e view progetto. |
| Router custom invoca Stripe feature dentro `source/` | `source/routes/web.php` linee 2-7 (`StripePayments`) | Endpoint pagamento non isolati come modulo installabile. |
| Composer autoload unisce Core e Project in un unico namespace graph | `composer.json` linee 28-43 (`Core\`, `Controllers\`, `Models\`, helper files) | Nessun boundary tecnico forte tra framework e applicazione. |

## Osservazioni tecniche rilevanti per estrazione

- Il **Core esiste già**, ma contiene punti “contaminati” da concerns progetto/integrazioni.
- La parte **ACF model pattern** (`BaseGroupAcf`, `FieldAcf`, `BasePostType`) è buona base riutilizzabile.
- Le integrazioni Woo/Stripe/OptionPages sono presenti ma non incapsulate in feature module dedicate.
- I template WordPress legacy chiamano controller staticamente: comodo, ma aumenta coupling col progetto.

## Proposta struttura finale del tema “pulito”

```text
theme/
  functions.php
  style.css
  composer.json
  package.json

  app/
    Core/                    # solo astrazioni/framework neutre
    Support/                 # helper utility, i18n, env, vite resolver
    Providers/               # provider generici

  features/
    WooCommerce/
      Bootstrap.php
      Hooks/*.php
    StripeDonations/
      Bootstrap.php
      Routes/web.php
      Services/StripePayments.php
      Services/DonationMailer.php
      Assets/js/*.js
    AcfOptionPages/
      Bootstrap.php
      Hooks/*.php
      Views/optionPages/*.blade.php

  project/
    Controllers/
    Models/
    Templates/              # template bridge php -> controller
    Views/                  # blade specifiche progetto
    Assets/                 # css/js/fonts/images progetto
```

## Strategia di estrazione consigliata (non eseguita in questo task)

1. Congelare comportamento corrente con smoke test su template principali.
2. Spostare callback Woo/ACF/Stripe da `app/Core/App.php` a bootstrap di feature.
3. Rendere `RouterProvider` configurabile (lista route da config/provider, non hardcoded `source/`).
4. Rendere `BaseController` agnostico dal path asset (resolver astratto/iniettabile).
5. Migrare `source/*` in `project/*` e introdurre `features/*` per integrazioni opzionali.
6. Tenere `app/Core/*` privo di business rules charity.

## Rischi individuati da gestire nel refactor

- Rottura hook WordPress (`template_redirect`, `admin_menu`, filtri ACF/Woo).
- Rottura mapping template gerarchia WP -> controller -> view.
- Rottura riferimenti ACF dinamici (group key, option page slug, nomi campi).
- Rottura asset loading Vite/manifest se cambiano path senza adapter.

## Conclusione

Il repository è già vicino a una separazione framework/progetto, ma va completata isolando:

- hook e bootstrap integrazioni in moduli feature,
- route pagamento fuori dal Core,
- asset resolver e controller base in forma completamente agnostica.

Con questi passi il tema può diventare un **starter framework riutilizzabile** con **project package** separato per il legacy charity.
