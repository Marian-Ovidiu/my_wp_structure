# Skill: WordPress Theme Architecture

## Purpose

Use this skill when working on architecture, refactors, or bug fixes in this WordPress theme repository.
The goal is to keep the theme stable while separating reusable framework concerns from project-specific code.

## WordPress Theme Lifecycle

At runtime, WordPress loads the active theme and executes theme bootstrap code.
In this repository, bootstrap starts from `functions.php`, where hooks, setup logic, and service registration are initialized.

After bootstrap:

1. WordPress resolves the requested route/content.
2. WordPress applies template hierarchy rules to pick a template file.
3. Theme-level logic (including controllers/hooks) prepares data.
4. Template rendering happens (including Blade templates where configured).

Any change that affects bootstrap order, hook registration, or template resolution can break frontend behavior.

## Role of `functions.php`

`functions.php` is the main entry point for theme setup.
Typical responsibilities in this repository:

- Registering/booting theme services and internal framework components.
- Registering WordPress hooks (`add_action`, `add_filter`).
- Enabling theme supports, menus, sidebars, and assets.
- Starting integrations used by controllers/templates.

Treat `functions.php` as critical infrastructure. Refactor incrementally and preserve execution order.

## Template Hierarchy

WordPress selects templates by its hierarchy (for example: singular, archive, taxonomy, page variants, fallback templates).
This repository follows WordPress hierarchy behavior and then delegates rendering to theme templates (including Blade views where mapped).

Rules for agents:

- Keep template filenames and placement aligned with hierarchy expectations.
- Do not rename template files unless every reference and hierarchy implication is verified.
- Preserve fallback templates so unresolved routes still render correctly.

## Blade Template Integration

Blade is used as the view engine layer on top of WordPress template resolution.
WordPress still controls *which* template is used; Blade controls *how* the selected view is rendered.

In practice:

- WordPress resolves template context.
- Theme/controller logic composes view data.
- Blade templates render final markup.

When editing Blade integration:

- Keep view paths/names consistent with loader configuration.
- Avoid breaking shared layouts/partials used across multiple templates.
- Ensure directives/components remain compatible with current Blade setup.

## Controllers and View Data

Controllers are used to prepare data before rendering views.
They often collect data from WordPress APIs, models, ACF fields, and feature services.

Guidelines:

- Keep controllers focused on data orchestration for templates.
- Move reusable cross-project logic to reusable layers, not template files.
- Avoid embedding heavy business rules inside rendering code.

If a template depends on a controller contract, keep keys and structures stable unless coordinated changes are applied.

## ACF Fields and Models

ACF fields may be referenced by:

- Field keys/names in templates/controllers.
- Model accessors/wrappers.
- Dynamically resolved field groups based on post type/context.

Guidelines:

- Do not remove or rename ACF references without tracing all call sites.
- Preserve expected return formats (array/object/scalar) used by templates.
- Keep model mapping aligned with existing field schema.

Seemingly small ACF changes can cause runtime null errors or empty UI sections.

## Asset Build Pipeline

Frontend assets are built with:

- Vite
- Tailwind CSS
- Alpine.js

Preferred approach:

- Use modular JS/CSS entrypoints.
- Keep bundling explicit and scoped by feature/page.
- Avoid introducing global scripts unless required by platform constraints.

When changing assets:

- Preserve existing entry registration in theme enqueue logic.
- Verify built filenames/manifests still match runtime loading logic.

## Interaction Map (How Parts Work Together)

1. `functions.php` boots theme services and hook registrations.
2. WordPress request lifecycle resolves content and selects template via hierarchy.
3. Controllers/models/ACF provide structured data for rendering.
4. Blade renders the selected view with prepared data.
5. Frontend bundles from Vite/Tailwind/Alpine provide client-side behavior and styling.

A safe refactor must preserve these interactions end-to-end.

## Common Agent Mistakes

Agents must avoid:

- Breaking WordPress hooks by changing/removing `add_action` or `add_filter` registrations without full impact checks.
- Renaming template files incorrectly, causing WordPress hierarchy mismatches.
- Removing ACF references that are dynamically used by controllers/templates/models.
- Changing template hierarchy behavior accidentally by moving/renaming fallback templates or altering template selection flow.
