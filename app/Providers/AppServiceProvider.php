<?php

namespace App\Providers;

use App\Interfaces\DistanceCalculatorInterface;
use App\Services\Calculators\HaversineDistanceCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            DistanceCalculatorInterface::class,
            HaversineDistanceCalculator::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
