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
            base_path('vendor/emojione/emojione/assets/png') => public_path('vendor/emojione/png'),
            base_path('vendor/emojione/emojione/assets/css/emojione.min.css') => public_path('vendor/emojione/css/emojione.min.css'),
            base_path('vendor/emojione/emojione/assets/svg') => public_path('vendor/emojione/svg'),
        ], 'public');

        $this->publishes([
            base_path('vendor/emojione/emojione/assets/sprites/emojione.sprites.css') => public_path('vendor/emojione/sprites/emojione.sprites.css'),
            base_path('vendor/emojione/emojione/assets/sprites/emojione.sprites.png') => public_path('vendor/emojione/sprites/emojione.sprites.png'),
            base_path('vendor/emojione/emojione/assets/sprites/emojione.sprites.svg') => public_path('vendor/emojione/sprites/emojione.sprites.svg'),
        ], 'sprites');

        \Blade::directive('emojione', function ($expression) {
            return "<?php echo resolve('".LaravelEmojiOne::class."')->toImage($expression); ?>";
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
