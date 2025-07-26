<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        /*if (config('app.env') === 'production') {
            //本番環境などではHTTPSを強制
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }*/
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS', 'on');
        
    }
}
