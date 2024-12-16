<?php

namespace BadMushroom\MojangApiClient;

use BadMushroom\MojangApiClient\Clients\ProfileClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MojangApiClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the configuration file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/mojang.php' => config_path('mojang.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mojang.php', 'mojang');

        // Register the service the package provides
        $this->app->bind('clients.mojang.profile', function ($app) {
            return new ProfileClient(
                Config::get('mojang.api_url'),
                Config::get('mojang.session_url')
            );
        });

        // ... register additional API clients here
    }
}
