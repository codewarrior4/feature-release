<?php

namespace Tests\Feature;

use App\Enums\LaunchStage;
use App\Features\EmergencyBrake;
use App\Features\LaunchMode;
use App\Features\OperatorConsole;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Laravel\Pennant\Feature;
use Tests\TestCase;

class FeatureFlightTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_the_showcase_defaults_to_public_traffic(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Public Traffic')
            ->assertSee('Signal Layer')
            ->assertSee('Priority navigation is held back.');
    }

    public function test_beta_audience_gets_the_scoped_experience(): void
    {
        $response = $this->get('/?audience=beta');

        $response
            ->assertOk()
            ->assertSee('Beta Circle')
            ->assertSee('Immersive Variant')
            ->assertSee('Priority navigation is live.');
    }

    public function test_emergency_brake_overrides_scoped_features_in_memory(): void
    {
        Feature::globally()->activate(EmergencyBrake::class);

        $response = $this->get('/?audience=beta');

        $response
            ->assertOk()
            ->assertSee('Brake engaged')
            ->assertSee('Recovery Skin')
            ->assertSee('Priority navigation is held back.');
    }

    public function test_launch_mode_can_be_updated_through_the_control_route(): void
    {
        $response = $this->from('/')->post('/controls', [
            'feature' => 'launch_mode',
            'value' => 'wide',
        ]);

        $response
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Launch mode set to Wide Rollout.');

        $this->assertSame(
            LaunchStage::Wide,
            Feature::globally()->value(LaunchMode::class),
        );
    }

    public function test_operator_console_can_be_enabled_through_the_control_route(): void
    {
        $response = $this->from('/')->post('/controls', [
            'feature' => 'operator_console',
            'state' => 'on',
        ]);

        $response
            ->assertRedirect('/')
            ->assertSessionHas('status', 'OperatorConsole enabled.');

        $this->assertTrue(Feature::globally()->active(OperatorConsole::class));
    }
}
