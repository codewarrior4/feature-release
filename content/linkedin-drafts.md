# LinkedIn Drafts

## 1. Feature flags as delivery infrastructure

Feature flags become valuable when they are treated as an operational system: explicit scopes, deterministic assignment, observable decisions, and a tested rollback path.

## 2. Why stable hashing matters

Percentage rollout is not `random_int()` on every request. Stable hashing keeps a subject in the same cohort, making metrics and support conversations trustworthy.

## 3. Rich values in Laravel Pennant

Boolean flags answer whether a path is active. Rich values answer which release stage or variant is active. Enums make those states readable in code and in operations.

## 4. The emergency brake

An in-memory `before()` hook is a practical safety valve. It can override a stored assignment immediately, while preserving the stored state needed to understand what happened.

## 5. Delete flags deliberately

Feature removal is part of release work. Once the new path is permanent, purge the old assignment, remove its resolver, and keep the decision record with the release documentation.
