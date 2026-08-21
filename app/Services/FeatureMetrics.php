<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FeatureMetrics
{
    /**
     * Return the release observations needed by the control room.
     */
    public function snapshot(): array
    {
        if (! Schema::hasTable('feature_events')) {
            return [
                'decisions' => 0,
                'updates' => 0,
                'rollbacks' => 0,
                'active_scopes' => 0,
                'latest' => collect(),
            ];
        }

        $events = DB::table('feature_events');

        return [
            'decisions' => (clone $events)->where('action', 'resolved')->count(),
            'updates' => (clone $events)->whereIn('action', ['updated', 'updated_all_scopes'])->count(),
            'rollbacks' => (clone $events)->where('action', 'rollback')->count(),
            'active_scopes' => (clone $events)->where('action', 'resolved')->distinct('scope')->count('scope'),
            'latest' => DB::table('feature_events')->latest()->limit(6)->get(),
        ];
    }
}
