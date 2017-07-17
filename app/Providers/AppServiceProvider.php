<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth0\Login\Contract\Auth0UserRepository as Auth0UserRepositoryContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //force SSL
        /*if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }*/
        $this->app->bind(
            Auth0UserRepositoryContract::class,
            \App\Repository\User::class); //'\Auth0\Login\Repository\Auth0UserRepository');
    }
}
