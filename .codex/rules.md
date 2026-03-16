# .codex/rules.md

## Hard Rules for Agents

1. Never introduce business-specific code into Core directories.
2. Never delete files unless all references are verified.
3. Do not rename WordPress template files without understanding template hierarchy impact.
4. Do not modify asset build configuration unless explicitly requested.
5. Keep the codebase WordPress-compatible at all times.
6. Prefer moving logic into Feature modules instead of increasing Core complexity.
7. Refactors must preserve behavior unless explicitly asked to change behavior.

## Additional Safety Rules

- Preserve theme bootstrap flow from `functions.php`.
- Do not break WordPress hooks (`add_action`, `add_filter`) or callback signatures.
- Keep Blade template loading and data contracts stable.
- Update namespaces/imports/autoload mappings when moving classes.
- Validate syntax and targeted runtime paths after each significant refactor step.
