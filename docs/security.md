# Feature Flag Security

Feature flags are not authorization. Any sensitive operator route must be protected by authentication and authorization before it is exposed outside this local showcase.

## Controls

- Validate feature names and values with `UpdateFeatureControlRequest`; never accept arbitrary class names from a request.
- Keep internal and regulated audiences behind explicit scopes and review them before widening exposure.
- Treat a feature's stored value as operational state. Restrict database access and do not expose raw feature tables to clients.
- Do not cache authorization decisions longer than the request unless the cache key includes the complete subject and feature context.
- The emergency brake is an in-memory override. It changes behavior immediately without purging stored history, which preserves rollback evidence.
- Record operator updates and rollbacks in `feature_events`; review this stream when investigating an incident.
