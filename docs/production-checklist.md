# Production Checklist

- [ ] Pennant database migration has run in the target environment.
- [ ] The feature store is configured for the intended persistence and cache strategy.
- [ ] Operator routes require authentication and explicit release authorization.
- [ ] Every feature has a resolver, owner, rollout stage, and removal date.
- [ ] Public, beta, internal, organization, and percentage-targeted paths have tests.
- [ ] Feature resolution and update events are visible in the monitoring system.
- [ ] Emergency brake behavior has been tested before the release begins.
- [ ] Rollback ownership and communication channel are documented.
- [ ] Old flags are purged with `php artisan pennant:purge` after code removal.
