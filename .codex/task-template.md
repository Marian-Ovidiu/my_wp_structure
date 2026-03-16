# Task Template for Agents

Agents should always use this structure when performing complex refactors.

## Goal

- Define the intended outcome in one clear sentence.

## Context

- Describe current architecture/runtime context needed to execute safely.
- Include relevant WordPress/theme constraints.

## Files Involved

- List files/directories likely to be touched.
- Mark Core vs Feature vs Project scope.

## Constraints

- List non-negotiable constraints (behavior parity, WordPress compatibility, hook safety, etc.).
- Call out forbidden changes if applicable.

## Steps

1. Inspect current implementation and dependency graph.
2. Plan incremental edits (small, reversible steps).
3. Apply refactor changes.
4. Update namespaces/imports/references.
5. Run syntax/build/runtime checks.
6. Confirm no hierarchy/hook/template regressions.

## Verification Checklist

- [ ] Core remains project-agnostic.
- [ ] WordPress hooks still registered and callable.
- [ ] Template hierarchy and Blade rendering still work.
- [ ] ACF/model references remain valid.
- [ ] PHP syntax checks pass for changed files.
- [ ] Asset/build pipeline still passes for touched frontend scope.
- [ ] Behavior preserved unless change was explicitly requested.
