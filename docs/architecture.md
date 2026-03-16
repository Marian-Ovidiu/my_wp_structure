# Theme Architecture

This document explains the architecture of the custom WordPress theme in this repository.
It is designed to help new developers and coding agents understand how the theme is structured and where new code should live.

## Quick Overview

The theme is organized in layered responsibilities:

- `Core`: reusable framework primitives.
- `Features`: optional integrations/extensions.
- `Project`: business-specific application code.

Main goal: keep `Core` reusable and project-agnostic while isolating project logic in `Features` and `Project` layers.

## Layer Diagram

```text
                    WordPress Runtime
                           |
                     functions.php
                           |
          +----------------+----------------+
          |                                 |
        Core                          Feature Modules
  (boot, base classes,            (Woo, Stripe, ACF options,
   Blade integration, router)       optional integrations)
          |                                 |
          +----------------+----------------+
                           |
                      Project Code
            (controllers, models, ACF groups,
               templates, business logic)
```

## Folder-Level Conceptual Map

```text
app/
  Core/              -> reusable abstractions and bootstrap glue
source/
  Controllers/       -> prepare view data
  Models/            -> post type + ACF-backed models
  Views/Templates/   -> Blade and theme templates
  Features/          -> optional domain/integration modules
```

Exact folder names may vary across modules, but the responsibilities above should remain stable.

## Request-to-Render Flow

```text
HTTP Request
  -> WordPress bootstrap
  -> Theme bootstrap (functions.php)
  -> Hooks / services / feature bootstrap registration
  -> WordPress template hierarchy selects template context
  -> Controller collects data (WP APIs + Models + ACF)
  -> Blade view renders markup
  -> Browser receives HTML/CSS/JS
```

## Controllers, Views, and ACF Models

### Controllers

Controllers orchestrate data for rendering:

- read from WordPress APIs (`WP_Query`, `get_post`, etc.);
- use post-type or ACF-backed models;
- compose a predictable view-data contract for templates.

### Views (Blade Templates)

Blade templates handle presentation:

- receive prepared data from controllers;
- render layouts/partials/components;
- avoid heavy business logic.

WordPress still controls template selection via hierarchy; Blade controls rendering of selected view files.

### ACF Models

ACF models map field groups and custom fields into structured objects:

- `BaseGroupAcf` pattern for group-based field sets;
- `BasePostType` pattern for post entities with ACF enrichment;
- centralized field access instead of scattered `get_field(...)` in templates.

This reduces duplication and keeps templates cleaner.

## Frontend Pipeline

The frontend stack uses:

- Vite for bundling/dev server and asset manifests;
- Tailwind CSS for utility-first styling;
- Alpine.js for lightweight interactivity.

### Frontend Flow

```text
Source JS/CSS
  -> Vite build
  -> bundled assets + manifest
  -> WordPress enqueue in theme bootstrap
  -> Blade templates reference enqueued assets
```

Guidelines:

- prefer modular entrypoints by page/feature;
- avoid unnecessary global scripts;
- keep asset registration aligned with the build output.

## Practical Rules for New Developers

- Keep `Core` generic and reusable.
- Put optional integrations into `Features`.
- Keep business rules in `Project` code.
- Preserve WordPress hooks and template hierarchy behavior.
- Refactor incrementally and verify syntax/build after changes.

## Onboarding Checklist

1. Read `AGENTS.md` and `.codex/rules.md`.
2. Identify whether your change belongs to Core, Feature, or Project layer.
3. Trace hook/template dependencies before renaming/moving files.
4. Validate PHP syntax and frontend build for touched scope.
