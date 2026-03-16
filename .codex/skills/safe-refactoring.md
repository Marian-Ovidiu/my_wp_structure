# Skill: Safe Refactoring

## Purpose

Use this skill when moving, renaming, or restructuring PHP/Blade/theme files in this repository.
The objective is to reduce regressions while preserving WordPress runtime behavior.

## Core Principles

- Prefer small, incremental refactors over large rewrites.
- Keep `app/Core` stable unless explicitly requested.
- Preserve theme bootstrap flow from `functions.php`.
- Preserve WordPress hooks and template resolution.

## Moving Files Safely

When moving a file:

- Check references first (class usage, includes, template calls, hook callbacks).
- Move one file/group at a time.
- Immediately update namespace and imports.
- Re-check autoload/composer mappings if folder structure changed.
- Re-run targeted checks before the next move.

Never delete old files until references are fully migrated.

## Renaming Classes Safely

When renaming classes:

- Rename class declaration and filename together.
- Update namespace if path changes.
- Update all usages (`use`, instantiations, static calls, string references).
- Check hook callbacks referencing class methods (`[ClassName::class, 'method']`, `[$object, 'method']`).

Avoid partial renames across only some layers.

## Updating Namespaces

Namespace updates must stay aligned with PSR-4/autoload expectations in this theme.

- Update `namespace` declaration in moved files.
- Update dependent `use` imports in all callers.
- Check factories/service boot code that may resolve classes by string.
- Check traits/interfaces/parent classes after namespace changes.

## Updating Imports

After moves/renames:

- Replace stale `use` statements.
- Remove orphan imports.
- Ensure aliased imports remain correct.
- Check Blade/PHP files that reference fully qualified class names.

## Checking WordPress Hooks

Hooks are runtime-critical and easy to break during refactors.

- Verify all `add_action` and `add_filter` callbacks still resolve.
- Verify hook priority/argument signatures did not change accidentally.
- Verify bootstrap still registers hooks in the expected order.
- Verify renamed classes/methods are updated in hook registration.

## Verifying Blade Templates

Blade rendering must remain stable after refactors.

- Verify template names/paths still match loader and WordPress hierarchy expectations.
- Verify data keys expected by Blade templates are still provided by controllers/models.
- Verify includes/extends/components still resolve.
- Avoid silent data contract changes between controller and view.

## Step-by-Step Safe Refactor Checklist

1. Identify dependencies
2. Move or rename file
3. Update namespaces
4. Update imports
5. Update references
6. Verify PHP syntax
7. Verify build scripts

## Quick Verification Commands (Examples)

Use repo-appropriate commands, for example:

- `php -l path/to/file.php` for syntax checks.
- theme build command (for example `npm run build` or project equivalent) for asset pipeline validation.
- optional targeted search checks for stale class names/imports.

Do not consider refactor complete until at least syntax and build checks pass for the touched scope.
