# Feature Release Architecture

This project treats Pennant as a release control plane. Application code resolves a feature through a class-based feature, while operators change stored values through the control route. The `instrumented` store uses Pennant's database driver with a small custom wrapper that counts storage reads and writes without changing Pennant semantics. A separate `redis` store is available for deployments that want feature state in Redis; opt into it with `PENNANT_STORE=redis`.

## Evaluation flow

1. The request selects an audience, organization, and visitor subject.
2. `Feature::for($scope)` resolves scoped flags and `Feature::globally()` resolves release-wide controls.
3. `before()` hooks run in memory first. The emergency brake can override stored values without deleting rollout history.
4. The Pennant decorator caches the result for the request and the configured driver persists resolved values.
5. Pennant events are recorded in `feature_events` for adoption, update, and rollback evidence.

## Scope model

- Audience scopes use `DemoAudience`, a serializable enum for public, beta, and internal traffic.
- Organization scopes use `DemoOrganization`, a serializable enum for partner targeting.
- Percentage rollout subjects use stable visitor identifiers and SHA-256 buckets, so the same visitor receives the same result on every request.

## Boundaries

Feature classes own release decisions. Controllers only compose resolved state for the view. `UpdateFeatureControlAction` is the only write path exposed by the showcase, and its Form Request constrains feature names and values before Pennant is called.
