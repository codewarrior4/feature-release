<?php

namespace App\Enums;

enum ThemeVariant: string
{
    case Signal = 'signal';
    case Immersive = 'immersive';
    case Control = 'control';
    case Recovery = 'recovery';

    public function label(): string
    {
        return match ($this) {
            self::Signal => 'Signal Layer',
            self::Immersive => 'Immersive Variant',
            self::Control => 'Control Room',
            self::Recovery => 'Recovery Skin',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Signal => 'Sharper storytelling and calm operator framing.',
            self::Immersive => 'Richer motion, bigger contrast, and faster visual tempo.',
            self::Control => 'Dense operational cues for the people closest to launch.',
            self::Recovery => 'Emergency-safe presentation while the rollout stabilizes.',
        };
    }
}
