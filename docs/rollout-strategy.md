# Rollout Strategy

Every release moves through `Steady Release`, `Canary Wave`, and `Wide Rollout`.

1. Start steady at 8% and watch latency and regressions.
2. Move to canary at 42% only after the first wave is healthy; watch adoption and error drift.
3. Move wide at 100% after the release has stable health and the operator layer shows no unresolved signals.
4. If the release is unhealthy, engage the emergency brake first. This changes the in-memory result immediately while leaving stored assignments intact.
5. After the incident, inspect `feature_events`, correct the underlying feature, and only then release the brake.

The `TelemetryPreview` feature demonstrates deterministic 5% rollout. A visitor is assigned by a hash of feature name and subject identifier, not by a random value generated per request.
