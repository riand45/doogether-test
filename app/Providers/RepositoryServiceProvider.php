<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\SessionRepositoryInterface;
use App\Repositories\Eloquent\SessionRepository;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\EloquentRepositoryInterface', 'App\Repositories\Eloquent\BaseRepository');
        $this->app->bind('App\Repositories\SessionRepositoryInterface', 'App\Repositories\Eloquent\SessionRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}