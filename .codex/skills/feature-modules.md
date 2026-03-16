# Skill: Feature Modules

## Purpose

Use this skill when implementing optional integrations or project-specific extensions that should remain isolated from the reusable Core.

The Feature layer is intended for modular capabilities that can be enabled, disabled, or replaced with limited impact on Core.

## Feature Pattern

A Feature module should follow these principles:

- Each feature has its own bootstrap/entrypoint.
- Feature code must not pollute `app/Core` with business-specific behavior.
- Features may register WordPress hooks, routes, service bindings, or helper functions.
- Feature dependencies should stay local to the feature whenever possible.

A feature should be self-contained enough that an agent can reason about it as a separate unit.

## Recommended Module Shape

Typical structure (conceptual):

- `FeatureName/Bootstrap.php` for registration/init
- `FeatureName/Controllers/*` for request/view data logic
- `FeatureName/Services/*` for integration/business operations
- `FeatureName/Hooks/*` for WordPress action/filter callbacks
- `FeatureName/Views/*` (optional) for feature-scoped templates/partials

Exact folders can vary, but bootstrap ownership and separation are mandatory.

## What Features Can Register

Depending on needs, a feature may register:

- `add_action` and `add_filter` callbacks
- Theme/application routes handled by feature controllers
- Feature-specific helpers/utilities
- ACF registrations related to the feature scope

All registrations must be deterministic and loaded from the feature bootstrap.

## Example Features

### WooCommerce Cleanup

A WooCommerce cleanup feature may:

- Remove/override default WooCommerce hooks for markup simplification.
- Register custom hooks for cart/checkout UI behavior.
- Keep WooCommerce-specific adjustments isolated from Core theme infrastructure.

### Stripe Donation System

A Stripe donations feature may:

- Register payment routes/endpoints and webhook handlers.
- Add donation form logic and validation hooks.
- Encapsulate API integration/service classes without leaking into Core abstractions.

### ACF Option Pages

An ACF options feature may:

- Register option pages and related ACF groups.
- Expose option-model accessors for templates/controllers.
- Keep option page registration out of generic Core bootstrapping.

## When Code Should Become a Feature

Move code to a Feature (instead of Core) when one or more apply:

- It is optional or integration-specific (e.g., WooCommerce, Stripe).
- It reflects project/business requirements rather than framework primitives.
- It can be toggled, replaced, or removed without breaking foundational theme runtime.
- It introduces external plugin/service coupling.

Keep code in Core only if it is genuinely reusable, project-agnostic, and foundational (bootstrapping, base abstractions, generic rendering/router glue).

## Guardrails for Agents

- Do not place feature-specific branching in Core classes.
- Keep feature bootstrap explicit and discoverable.
- Keep hook registration close to feature code.
- Preserve WordPress compatibility and existing behavior during extraction.
