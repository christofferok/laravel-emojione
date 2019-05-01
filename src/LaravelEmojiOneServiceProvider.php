<?php

namespace ChristofferOK\LaravelEmojiOne;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class LaravelEmojiOneServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/emojione.php' => config_path('emojione.php')], 'config');

        $this->publishes([
            base_path('vendor/emojione/assets/png') => public_path('vendor/emojione/png'),
        ], 'public');

        $this->publishes([
            base_path('vendor/emojione/assets/sprites') => public_path('vendor/emojione/sprites'),
        ], 'sprites');

        \Blade::directive('emojione', function ($expression) {
            list($string, $method) = explode(',', $expression);
            return "<?php echo \App::make('" . LaravelEmojiOne::class . "')->{{$method}}($string); ?>";
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/emojione.php', 'emojione');
        $this->app->singleton(LaravelEmojiOne::class, function (Container $app) {
            return new LaravelEmojiOne();
        });
    }
}
