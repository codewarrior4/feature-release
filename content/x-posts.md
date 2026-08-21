# X Post Drafts

## 1

Feature flags are release infrastructure, not scattered `if` statements. This Laravel Pennant lab makes scopes, rollout stages, recovery, and evidence visible in one control room.

## 2

A deterministic percentage rollout should not reshuffle users on every request. Hash the feature and subject together, then keep the bucket stable.

## 3

The safest rollback is often an in-memory `before()` override: change behavior immediately without deleting the assignments you need for the incident review.

## 4

Rich feature values are more expressive than booleans. A Pennant enum can represent steady, canary, and wide release stages while the same feature API remains intact.

## 5

If a release cannot show who was evaluated, what changed, and when it rolled back, it is not ready for production.
