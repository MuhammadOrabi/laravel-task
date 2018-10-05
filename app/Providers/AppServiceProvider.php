<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Proposal;
use App\Observers\ProposalObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Proposal::observe(ProposalObserver::class);        
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            if (class_exists('Vluzrmos\Tinker\TinkerServiceProvider')) {
                $this->app->register('Vluzrmos\Tinker\TinkerServiceProvider');
            }
            $this->app->register('Wn\Generators\CommandsServiceProvider');
        }
    }
}
