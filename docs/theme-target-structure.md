# Theme Target Structure

## Obiettivo

Definire un perimetro più pulito del tema separando in modo esplicito:

- `app/Core`
- `app/Support`
- `app/Helpers`
- `app/Features`
- `resources/views/layouts`
- `resources/views/components`
- `resources/views/pages`
- `resources/views/partials`

La riorganizzazione è stata fatta con refactor strutturale e con compatibilità temporanea verso il codice legacy.

## Struttura target

```text
app/
  Core/
  Support/
  Helpers/
  Features/

resources/views/
  layouts/
  components/
  pages/
  partials/
```

## Motivo di ogni directory

### `app/Core`

Contiene bootstrap e astrazioni base riutilizzabili:

- app lifecycle
- router
- blade manager
- classi base (`BaseController`, `BaseGroupAcf`, `BasePostType`, ecc.)

Regola: niente business logic specifica progetto.

### `app/Support`

Contiene supporto tecnico trasversale e riusabile, senza dipendenza dal dominio business:

- utilità env/path/asset (`utility_helpers.php`)
- traduzioni statiche (`translation_helpers.php`)

Serve a ridurre il rumore dentro `Helpers` e mantenere il Core più pulito.

### `app/Helpers`

Contiene entrypoint helper caricati da Composer (`autoload.files`) e oggi funge da layer di compatibilità.

Stato attuale:

- i file in `app/Helpers` sono shim compatibili che `require_once` i file reali in `Support` o `Features`.

Questo evita rotture immediate mentre si migra il codice verso i nuovi namespace/percorsi.

### `app/Features`

Contiene moduli opzionali, ognuno isolato per integrazione:

- `Features/WooCommerce/woocommerce_helpers.php`
- `Features/AcfOptions/acf_helpers.php`

Regola: integrazioni plugin/servizi non devono inquinare il Core.

### `resources/views/layouts`

Layout Blade condivisi (struttura pagina, `<head>`, shell comune).

### `resources/views/components`

Componenti Blade riutilizzabili (blocchi UI modulari e composabili).

### `resources/views/pages`

Template pagina completi (view page-level) separati dai componenti.

Sono state spostate qui le view principali:

- `home`, `aziende`, `galleria`, `grazie`
- `archivio-post`, `archivio-progetto`
- `singolo-post`, `single-progetto`

### `resources/views/partials`

Frammenti Blade “strutturali”/di sezione (menu, pezzi ricorrenti non componentizzati).

## Compatibilità temporanea mantenuta

Per non rompere il tema durante la transizione:

- `app/Helpers/acf_helpers.php` -> shim verso `app/Features/AcfOptions/acf_helpers.php`
- `app/Helpers/woocommerce_helpers.php` -> shim verso `app/Features/WooCommerce/woocommerce_helpers.php`
- `app/Helpers/utility_helpers.php` -> shim verso `app/Support/utility_helpers.php`
- `app/Helpers/translation_helpers.php` -> shim verso `app/Support/translation_helpers.php`

Per le view:

- i file legacy in `resources/views/*.blade.php` sono bridge che includono `resources/views/pages/*`.
- quindi i controller esistenti che renderizzano nomi vecchi (es. `home`) continuano a funzionare.

## Nota operativa per step successivi

Passo successivo consigliato (non incluso in questo task): aggiornare gradualmente i controller a renderizzare direttamente `pages.*` e poi rimuovere i bridge legacy quando tutte le referenze sono migrate.
