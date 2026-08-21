<?php

namespace App\Providers;

use App\Pennant\Drivers\InstrumentedDatabaseDriver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Events\FeatureResolved;
use Laravel\Pennant\Events\FeatureUpdated;
use Laravel\Pennant\Events\FeatureUpdatedForAllScopes;
use Laravel\Pennant\Feature;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Feature::extend('instrumented', function ($app, array $config): InstrumentedDatabaseDriver {
            return new InstrumentedDatabaseDriver(
                $app['db'],
                $app['events'],
                $app['config'],
                'instrumented',
                [],
            );
        });

        Feature::discover();

        Event::listen(FeatureResolved::class, function (FeatureResolved $event): void {
            $this->recordFeatureEvent('resolved', $event->feature, $event->scope, $event->value);
        });

        Event::listen(FeatureUpdated::class, function (FeatureUpdated $event): void {
            $action = $event->value === false ? 'rollback' : 'updated';

            $this->recordFeatureEvent($action, $event->feature, $event->scope, $event->value);
        });

        Event::listen(FeatureUpdatedForAllScopes::class, function (FeatureUpdatedForAllScopes $event): void {
            $this->recordFeatureEvent('updated_all_scopes', $event->feature, null, $event->value);
        });
    }

    private function recordFeatureEvent(string $action, string $feature, mixed $scope, mixed $value): void
    {
        if (! Schema::hasTable('feature_events')) {
            return;
        }

        DB::table('feature_events')->insert([
            'feature' => $feature,
            'scope' => Feature::serializeScope($scope),
            'action' => $action,
            'value' => is_scalar($value) || $value === null ? (string) $value : json_encode($value),
            'metadata' => json_encode(['store' => config('pennant.default')]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
