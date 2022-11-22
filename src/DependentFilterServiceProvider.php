<?php

namespace AwesomeNova;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class DependentFilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            array_unshift(
                Nova::$scripts, Script::remote(mix('filter.js', 'vendor/jeffersonsimaogoncalves/dependent-filter'))
            );
        });

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/jeffersonsimaogoncalves/dependent-filter'),
        ], ['nova-assets', 'laravel-assets']);

        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    /**
     * Get the Nova route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'namespace' => 'AwesomeNova\Http\Controllers',
            'domain' => config('nova.domain', null),
            'as' => 'nova.api.',
            'prefix' => 'nova-api',
            'middleware' => 'nova',
        ];
    }
}
