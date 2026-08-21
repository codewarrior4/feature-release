# Feature Flags Are a Release Control Plane

Shipping code and releasing behavior are different operations. Code deployment answers whether a capability exists in production; a feature flag answers who is allowed to experience it and how quickly exposure can expand.

Laravel Pennant gives the application a small, composable API for that control plane. Class-based features keep decisions close to the behavior they protect. Serializable enum scopes make audience and organization targeting explicit. Rich values let a release move through named stages rather than a growing collection of unrelated booleans.

The operational difference is observability. A rollout needs stable assignment, evidence of resolved decisions, a clear update trail, and a rollback that can act before a database cleanup. This project combines Pennant's `before()` interception hook with deterministic percentage assignment and persisted feature events so the release team can see and change the flight without deploying new application code.

The final lesson is lifecycle discipline. Every flag needs an owner, a rollout plan, a recovery plan, and a removal date. A flag that never gets removed becomes permanent architecture hidden behind temporary language.
