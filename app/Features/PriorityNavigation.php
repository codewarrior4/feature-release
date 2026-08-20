<?php

namespace App\Features;

use App\Enums\DemoAudience;
use Laravel\Pennant\Feature;

class PriorityNavigation
{
    /**
     * Run an in-memory emergency check before reading stored values.
     */
    public function before(DemoAudience $audience): ?bool
    {
        if (! Feature::globally()->active(EmergencyBrake::class)) {
            return null;
        }

        return $audience === DemoAudience::Internal;
    }

    /**
     * Resolve the feature's initial value.
     */
    public function resolve(DemoAudience $audience): mixed
    {
        return match ($audience) {
            DemoAudience::Public => false,
            DemoAudience::Beta, DemoAudience::Internal => true,
        };
    }
}
