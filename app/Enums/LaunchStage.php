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
}
