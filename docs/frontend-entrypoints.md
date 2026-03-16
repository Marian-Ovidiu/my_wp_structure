# Frontend Entrypoints

## Obiettivo

Separare il bootstrap frontend globale dalle logiche business-specific, caricando gli script di feature solo nelle view/controller che li richiedono.

## Entrypoint base (globale tema)

File: `wp-content/themes/my_structure/source/assets/js/main.js`

Responsabilità:

- bootstrap Alpine.js;
- registrazione plugin Alpine (`@alpinejs/intersect`);
- esposizione utility trasversali globali:
  - `window.axios`
  - `window.ApiService`
  - `window.Alpine`

Non contiene più logiche donation, highlight o slider.

## Entrypoint specifici per pagina/feature

Questi file sono caricati solo dove servono (via controller `addJs(...)`):

- `source/assets/js/donation.js`  
  caricato nelle pagine donation/progetti; espone `window.donationFormData`.
- `source/assets/js/highlight.js`  
  caricato nelle pagine galleria; espone `window.typingEffect`.
- `source/assets/js/homeSlider.js`  
  caricato in homepage con dipendenza Swiper CDN.
- `source/assets/js/progettoSlider.js`  
  caricato nella pagina singolo progetto con dipendenza Swiper CDN.
- `source/assets/js/single-donation.js`  
  entrypoint donation per scenario single progetto (quando abilitato).

## Regola di caricamento

- Tutto ciò che è trasversale a tutto il tema va in `main.js`.
- Tutto ciò che è di dominio/feature/pagina resta in file dedicati caricati dal controller della pagina.
- Evitare import business-specific nel bootstrap globale.

## Note build Vite

- La build Vite resta invariata e funzionante con entrypoint base `main.js` + `style.scss`.
- Gli script pagina-specifici restano separati e vengono enqueue-ati on-demand dalla logica PHP dei controller.
