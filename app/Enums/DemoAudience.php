<?php

namespace App\Enums;

use Laravel\Pennant\Contracts\FeatureScopeSerializeable;

enum DemoAudience: string implements FeatureScopeSerializeable
{
    case Public = 'public';
    case Beta = 'beta';
    case Internal = 'internal';

    public static function fromRequest(?string $value): self
    {
        return self::tryFrom((string) $value) ?? self::Public;
    }

    public function label(): string
    {
        return match ($this) {
            self::Public => 'Public Traffic',
            self::Beta => 'Beta Circle',
            self::Internal => 'Internal Crew',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Public => 'Conservative defaults for a broad launch audience.',
            self::Beta => 'Early adopters seeing higher-signal upgrades first.',
            self::Internal => 'Team members with the fullest release surface.',
        };
    }

    public function featureScopeSerialize(): string
    {
        return $this->value;
    }
}
