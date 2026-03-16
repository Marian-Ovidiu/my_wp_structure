# AGENTS.md

## 1. Repository Purpose

This repository contains a custom WordPress theme built with a small internal framework (`Core` layer) plus project-specific layers.

The current objective is to extract a reusable starter theme framework from a legacy nonprofit project, while preserving existing behavior during migration.

## 2. Architectural Layers

### Core Layer (Reusable, Project-Agnostic)
- `app/Core`
- Base abstractions
- Theme bootstrapping
- Blade integration
- Router

This is the only layer that must remain reusable and free of project-specific business rules.

### Support Layer
- Helpers
- Utilities

Shared support code used across Core, Features, and Project layers.

### Feature Layer
- Optional integrations
- WooCommerce
- Stripe donations
- Other project features

Feature code may depend on project needs, but should remain modular and isolated.

### Project Layer
- Controllers
- Models
- ACF groups
- Templates
- Business logic

This layer contains project-specific implementation details and domain behavior.

## 3. Safe Refactoring Rules

Agents must follow these rules:

- Never modify Core layer behavior unless explicitly requested.
- Do not introduce business logic into Core.
- Prefer moving project logic into Feature or Project layers.
- Preserve WordPress compatibility.
- Do not break template loading or theme bootstrap.

## 4. File Modification Strategy

When refactoring:

- Prefer incremental refactors over large rewrites.
- Do not delete files before checking references.
- Update imports/autoload mappings after file moves.
- Verify PHP syntax after edits.
- Keep Blade templates valid and renderable.

## 5. WordPress Constraints

WordPress runtime constraints:

- Theme bootstrap starts in `functions.php`.
- Controllers may be referenced directly by templates.
- ACF fields may be referenced dynamically.
- Some logic is executed through WordPress hooks/actions/filters.

Agents must avoid breaking hook registration and execution flow.

## 6. Frontend Rules

Frontend stack and guidelines:

- Vite
- Tailwind CSS
- Alpine.js
- Prefer modular JavaScript entrypoints.
- Avoid global scripts unless strictly necessary.

## 7. Refactor Goal

Primary goal: extract a reusable starter theme framework from the legacy project, while keeping existing project behavior stable.

## Pre-Completion Checklist for Agents

Before concluding any change:

- Confirm Core remains reusable and project-agnostic.
- Confirm no business logic was added to Core.
- Confirm WordPress bootstrap and hooks still work.
- Confirm template loading (including Blade) is intact.
- Confirm moved files have updated imports/autoload references.
- Confirm PHP files pass syntax checks.
- Confirm frontend entrypoints remain modular and valid.
