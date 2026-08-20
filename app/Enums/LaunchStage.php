<?php

namespace App\Enums;

enum LaunchStage: string
{
    case Steady = 'steady';
    case Canary = 'canary';
    case Wide = 'wide';

    public function label(): string
    {
        return match ($this) {
            self::Steady => 'Steady Release',
            self::Canary => 'Canary Wave',
            self::Wide => 'Wide Rollout',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Steady => 'Tight exposure with careful observation and low blast radius.',
            self::Canary => 'Measured expansion while operator telemetry stays visible.',
            self::Wide => 'Confident release mode when the showcase is ready to breathe.',
        };
    }

    public function exposure(): string
    {
        return match ($this) {
            self::Steady => '8%',
            self::Canary => '42%',
            self::Wide => '100%',
        };
    }

    public function monitorFocus(): string
    {
        return match ($this) {
            self::Steady => 'Latency + regressions',
            self::Canary => 'Adoption + error drift',
            self::Wide => 'Sustained health',
        };
    }
}
