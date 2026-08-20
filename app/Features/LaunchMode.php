<?php

namespace App\Features;

use App\Enums\LaunchStage;

class LaunchMode
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(mixed $scope): mixed
    {
        return LaunchStage::Steady;
    }
}
