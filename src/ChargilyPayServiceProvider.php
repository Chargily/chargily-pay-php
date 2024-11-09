<?php

namespace Chargily\ChargilyPay;

use Illuminate\Support\ServiceProvider;

class ChargilyPayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->offerPublishing();
    }

    public function register()
    {
        // Merge configuration from the package
        $this->mergeConfigFrom(__DIR__ . '/../config/chargilypay.php', 'chargilypay');

        // Register ChargilyPay as a singleton with injected credentials
        $this->app->singleton(ChargilyPay::class, function ($app) {
            $credentials = new \Chargily\ChargilyPay\Auth\Credentials([
                'mode'       => config('chargilypay.mode'),
                'public' => config('chargilypay.public_key'),
                'secret' => config('chargilypay.secret_key')
            ]);

            return new ChargilyPay($credentials);
        });
    }

    protected function offerPublishing(): void
    {
        // Only publish when running in console and `config_path` is available
        if ($this->app->runningInConsole() && function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/chargilypay.php' => config_path('chargilypay.php'),
            ], 'config');
        }
    }
}
