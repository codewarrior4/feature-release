# Incident Response

## Stop the blast radius

1. Open the Launch Observatory and identify the affected audience, organization, or visitor cohort.
2. Engage the emergency brake. Confirm that the resolved theme changes to Recovery Skin and the affected scoped flag is intercepted.
3. Set the release wave back to Steady Release if the stored rollout should remain conservative after recovery.

## Investigate

- Inspect `feature_events` for the first update, affected scopes, and rollback sequence.
- Compare resolved decisions with application errors, latency, and adoption telemetry.
- Verify whether the issue is limited to one organization or present across every audience.

## Recover and close

1. Patch or remove the faulty feature definition.
2. Test the feature with public, beta, internal, and targeted organization scopes.
3. Release the brake, watch the steady wave, and progress through the normal rollout stages.
4. Record the incident, the decision, and the flag removal date in the release log.
