<?php

namespace App\Http\Controllers;

use App\Actions\UpdateFeatureControlAction;
use App\Http\Requests\UpdateFeatureControlRequest;
use Illuminate\Http\RedirectResponse;

class FeatureControlController extends Controller
{
    public function __invoke(
        UpdateFeatureControlRequest $request,
        UpdateFeatureControlAction $updateFeatureControl,
    ): RedirectResponse {
        $message = $updateFeatureControl->handle($request->validated());

        return back()->with('status', $message);
    }
}
