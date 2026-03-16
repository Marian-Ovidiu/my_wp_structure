# My Structure Starter Theme

Minimal WordPress starter theme with:

- WordPress bootstrap (`functions.php`)
- Blade rendering layer
- Vite asset pipeline
- Tailwind CSS
- Alpine.js

## Quick Start

1. Install dependencies:

```bash
composer install
npm install
```

2. Build assets:

```bash
npm run dev
```

or for production:

```bash
npm run build
```

3. Activate the theme in WordPress.

## Starter Structure

- `app/Core`: framework core (bootstrap, router, blade manager, base classes)
- `app/Helpers`: generic helper functions
- `app/Features`: optional feature modules
- `source/Controllers`: project controllers (start from `ExampleController`)
- `source/Models`: project models (includes ACF demo model)
- `resources/views`: Blade templates
- `source/assets`: JS/SCSS/assets source files for Vite

## Create a New Controller

1. Add a class in `source/Controllers`, extending `Core\Bases\BaseController`.
2. Add your action method (for example `landing()`).
3. Render a Blade view with:

```php
$this->render('pages.landing', ['title' => 'Landing']);
```

4. Point a template file to the controller:

```php
\Controllers\YourController::call('landing');
```

## Create a New Blade View

1. Add a new file under `resources/views/pages`, for example `landing.blade.php`.
2. Extend the main layout:

```blade
@extends('layouts.mainLayout')

@section('content')
    <section class="py-12">
        <h1>{{ $title }}</h1>
    </section>
@stop
```

## Define an ACF Model (BaseGroupAcf pattern)

Use the demo class `source/Models/Demo/DemoGroupFields.php` as template.

1. Create a new class extending `Core\Bases\BaseGroupAcf`.
2. Set `protected $groupKey`.
3. Define fields in `defineAttributes()` using `$this->addField('field_name')`.
4. Use it from your code with `YourGroup::get('option')` or a post ID.

## Add Optional Features

1. Enable feature classes in `app/Config/features.php`, for example:

```php
return [
    Features\TranslationFeature\TranslationFeature::class,
    Features\AcfOptionsFeature\AcfOptionsFeature::class,
];
```

2. For ACF options pages, configure `app/Config/options.php`.

## Demo Page

The starter includes a demo homepage rendered via Blade:

- Entry point: `front-page.php`
- Controller action: `Controllers\ExampleController::home()`
- View: `resources/views/pages/home-demo.blade.php`
