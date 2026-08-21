<?php

namespace Tests\Unit;

use App\Pennant\Drivers\RedisDriver;
use App\Support\PercentageRollout;
use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;
use Tests\TestCase;

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

    public function test_cache_driver_persists_and_retrieves_scoped_values(): void
    {
        $driver = new RedisDriver(new Repository(new ArrayStore));
        $driver->define('preview', fn (string $scope): bool => $scope === 'beta');

        $this->assertTrue($driver->get('preview', 'beta'));
        $this->assertFalse($driver->get('preview', 'public'));
    }
}
