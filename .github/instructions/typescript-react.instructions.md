---
description: TS/React conventions for UI code
applyTo: "**/*.{ts,tsx}"
---
# TS/React Conventions
- Components: `PascalCase`. Hooks: `useX`.
- Props: define interfaces; no `any`. Prefer discriminated unions for variants.
- State: keep minimal; lift when shared; derive where possible.
- Side effects: isolate in hooks; handle cleanup.
- Styling: CSS Modules or scoped styles; no global leakage.
- Testing: generate minimal unit tests for hooks and pure components.