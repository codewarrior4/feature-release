<?php

namespace App\Enums;

use Laravel\Pennant\Contracts\FeatureScopeSerializeable;

enum DemoOrganization: string implements FeatureScopeSerializeable
{
    case Acme = 'acme';
    case Northstar = 'northstar';
    case Orbit = 'orbit';

    public static function fromRequest(?string $value): self
    {
        return self::tryFrom((string) $value) ?? self::Acme;
    }

    public function label(): string
    {
        return match ($this) {
            self::Acme => 'Acme Labs',
            self::Northstar => 'Northstar Health',
            self::Orbit => 'Orbit Commerce',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Acme => 'Early partner with the broadest test surface.',
            self::Northstar => 'Regulated partner held to a conservative rollout.',
            self::Orbit => 'High-volume partner used for adoption signals.',
        };
    }

    public function featureScopeSerialize(): string
    {
        return $this->value;
    }
}
