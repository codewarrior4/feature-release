<?php

namespace Tests\Feature;

use App\Enums\DemoOrganization;
use App\Features\EmergencyBrake;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Pennant\Feature;
use Tests\TestCase;

class FeatureObservabilityTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_showcase_evaluates_targeting_inputs(): void
    {
        $response = $this->get('/?organization=acme&visitor=visitor-42');

        $response
            ->assertOk()
            ->assertSee('Targeting lab')
            ->assertSee('Acme Labs')
            ->assertSee('Percentage rollout');
    }

    public function test_feature_events_capture_resolution_and_rollback(): void
    {
        $this->get('/')->assertOk();

        Feature::globally()->deactivate(EmergencyBrake::class);

        $this->assertGreaterThan(0, DB::table('feature_events')->where('action', 'resolved')->count());
        $this->assertSame(1, DB::table('feature_events')->where('action', 'rollback')->count());
    }

    public function test_organization_scope_serializes_for_pennant(): void
    {
        $this->assertSame('acme', Feature::serializeScope(DemoOrganization::Acme));
    }
}
