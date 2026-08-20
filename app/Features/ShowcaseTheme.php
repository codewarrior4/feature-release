<?php

namespace App\Features;

use App\Enums\DemoAudience;
use App\Enums\ThemeVariant;
use Laravel\Pennant\Feature;

class ShowcaseTheme
{
    /**
     * Run an in-memory emergency check before reading stored values.
     */
    public function before(DemoAudience $audience): ?ThemeVariant
    {
        if (! Feature::globally()->active(EmergencyBrake::class)) {
            return null;
        }

        return ThemeVariant::Recovery;
    }

    /**
     * Resolve the feature's initial value.
     */
    public function resolve(DemoAudience $audience): mixed
    {
        return match ($audience) {
            DemoAudience::Public => ThemeVariant::Signal,
            DemoAudience::Beta => ThemeVariant::Immersive,
            DemoAudience::Internal => ThemeVariant::Control,
        };
    }
}
