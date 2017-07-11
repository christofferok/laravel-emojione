<?php

namespace ChristofferOK\LaravelEmojiOne;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class LaravelEmojiOneServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__.'/../config/emojione.php' => config_path('emojione.php')], 'config');

        $this->publishes([
            base_path('vendor/emojione/assets/png') => public_path('vendor/emojione/png'),
        ], 'public');

        $this->publishes([
            base_path('vendor/emojione/assets/sprites') => public_path('vendor/emojione/sprites'),
        ], 'sprites');

        \Blade::directive('emojione', function ($expression) {
            return "<?php echo \App::make('".LaravelEmojiOne::class."')->toImage($expression); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/emojione.php', 'emojione');
        $this->app->singleton(LaravelEmojiOne::class, function (Container $app) {
            return new LaravelEmojiOne();
        });
    }
}
