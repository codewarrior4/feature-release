<?php

namespace App\Actions;

use App\Enums\LaunchStage;
use App\Features\EmergencyBrake;
use App\Features\LaunchMode;
use App\Features\OperatorConsole;
use Laravel\Pennant\Feature;

class UpdateFeatureControlAction
{
    /**
     * @param  array{feature: string, state?: ?string, value?: ?string}  $payload
     */
    public function handle(array $payload): string
    {
        return match ($payload['feature']) {
            'emergency_brake' => $this->toggle(EmergencyBrake::class, $payload['state'] ?? null),
            'operator_console' => $this->toggle(OperatorConsole::class, $payload['state'] ?? null),
            'launch_mode' => $this->setLaunchMode($payload['value'] ?? null),
            default => 'No change applied.',
        };
    }

    private function toggle(string $feature, ?string $state): string
    {
        if ($state === 'on') {
            Feature::globally()->activate($feature);

            return class_basename($feature).' enabled.';
        }

        Feature::globally()->deactivate($feature);

        return class_basename($feature).' disabled.';
    }

    private function setLaunchMode(?string $value): string
    {
        $launchStage = LaunchStage::from((string) $value);

        Feature::globally()->activate(LaunchMode::class, $launchStage);

        return 'Launch mode set to '.$launchStage->label().'.';
    }
}
