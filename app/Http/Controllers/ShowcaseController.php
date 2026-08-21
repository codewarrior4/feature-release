<?php

namespace App\Http\Controllers;

use App\Enums\DemoAudience;
use App\Enums\DemoOrganization;
use App\Enums\LaunchStage;
use App\Enums\ThemeVariant;
use App\Features\EmergencyBrake;
use App\Features\LaunchMode;
use App\Features\OperatorConsole;
use App\Features\OrganizationInsights;
use App\Features\PriorityNavigation;
use App\Features\ShowcaseTheme;
use App\Features\TelemetryPreview;
use App\Services\FeatureMetrics;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Pennant\Feature;

class ShowcaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, FeatureMetrics $metrics): View
    {
        $audience = DemoAudience::fromRequest($request->string('audience')->toString());
        $organization = DemoOrganization::fromRequest($request->string('organization')->toString());
        $visitor = $request->string('visitor')->toString() ?: 'demo-visitor-42';
        $audienceState = Feature::for($audience)->values([PriorityNavigation::class, ShowcaseTheme::class]);
        $globalState = Feature::globally()->values([EmergencyBrake::class, LaunchMode::class, OperatorConsole::class]);
        $showcaseTheme = $audienceState[ShowcaseTheme::class];
        $launchStage = $globalState[LaunchMode::class];

        $showcaseTheme = $showcaseTheme instanceof ThemeVariant
            ? $showcaseTheme
            : ThemeVariant::from((string) $showcaseTheme);
        $launchStage = $launchStage instanceof LaunchStage
            ? $launchStage
            : LaunchStage::from((string) $launchStage);

        return view('showcase', [
            'audience' => $audience,
            'audiences' => DemoAudience::cases(),
            'organizations' => DemoOrganization::cases(),
            'organization' => $organization,
            'visitor' => $visitor,
            'telemetryPreview' => Feature::for($visitor)->active(TelemetryPreview::class),
            'organizationInsights' => Feature::for($organization)->active(OrganizationInsights::class),
            'metrics' => $metrics->snapshot(),
            'priorityNavigation' => (bool) $audienceState[PriorityNavigation::class],
            'showcaseTheme' => $showcaseTheme,
            'emergencyBrake' => (bool) $globalState[EmergencyBrake::class],
            'launchStage' => $launchStage,
            'operatorConsole' => (bool) $globalState[OperatorConsole::class],
        ]);
    }
}
