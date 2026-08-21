<?php

namespace Tests\Unit;

use App\Support\PercentageRollout;
use PHPUnit\Framework\TestCase;

class PercentageRolloutTest extends TestCase
{
    public function test_rollout_is_stable_and_respects_boundaries(): void
    {
        $rollout = new PercentageRollout;

        $this->assertFalse($rollout->includes('feature', 'visitor', 0));
        $this->assertTrue($rollout->includes('feature', 'visitor', 100));
        $this->assertSame(
            $rollout->includes('feature', 'visitor', 5),
            $rollout->includes('feature', 'visitor', 5),
        );
    }
}
