<?php

namespace App\Pennant\Drivers;

use Illuminate\Support\Facades\Cache;
use Laravel\Pennant\Drivers\DatabaseDriver;

class InstrumentedDatabaseDriver extends DatabaseDriver
{
    /**
     * Count storage reads without changing Pennant's database behavior.
     */
    public function get($feature, $scope): mixed
    {
        $this->increment('reads');

        return parent::get($feature, $scope);
    }

    /**
     * Count stored updates without changing Pennant's database behavior.
     */
    public function set($feature, $scope, $value): void
    {
        $this->increment('writes');

        parent::set($feature, $scope, $value);
    }

    private function increment(string $operation): void
    {
        $key = 'pennant:driver:'.$operation;

        Cache::add($key, 0, now()->addDay());
        Cache::increment($key);
    }
}
