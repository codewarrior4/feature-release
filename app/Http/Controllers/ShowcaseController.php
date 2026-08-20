<?php

namespace App\Http\Controllers;

use App\Enums\DemoAudience;
use App\Features\EmergencyBrake;
use App\Features\LaunchMode;
use App\Features\OperatorConsole;
use App\Features\PriorityNavigation;
use App\Features\ShowcaseTheme;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Pennant\Feature;

class ShowcaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $audience = DemoAudience::fromRequest($request->string('audience')->toString());
        $audienceState = Feature::for($audience)->values([PriorityNavigation::class, ShowcaseTheme::class]);
        $globalState = Feature::globally()->values([EmergencyBrake::class, LaunchMode::class, OperatorConsole::class]);

        return view('showcase', [
            'audience' => $audience,
            'audiences' => DemoAudience::cases(),
            'priorityNavigation' => (bool) $audienceState[PriorityNavigation::class],
            'showcaseTheme' => $audienceState[ShowcaseTheme::class],
            'emergencyBrake' => (bool) $globalState[EmergencyBrake::class],
            'launchStage' => $globalState[LaunchMode::class],
            'operatorConsole' => (bool) $globalState[OperatorConsole::class],
        ]);
    }
}
