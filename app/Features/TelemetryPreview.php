<?php

namespace App\Features;

use App\Support\PercentageRollout;

class TelemetryPreview
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(string $scope): bool
    {
        return app(PercentageRollout::class)->includes(self::class, $scope, 5);
    }
}
