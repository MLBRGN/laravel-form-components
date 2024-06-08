<?php

namespace Mlbrgn\LaravelFormComponents\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Mlbrgn\LaravelFormComponents\FormDataBinder;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('form-components.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/form-components'),
            ], 'views');
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'form-components');

        //

        Blade::directive('bind', function ($bind) {
            return '<?php app(\ProtoneMedia\LaravelFormComponents\FormDataBinder::class)->bind(' . $bind . '); ?>';
        });

        Blade::directive('endbind', function () {
            return '<?php app(\ProtoneMedia\LaravelFormComponents\FormDataBinder::class)->pop(); ?>';
        });

        //

//        $prefix = config('form-components.prefix');
//
//        Collection::make(config('form-components.components'))->each(
//            fn ($component, $alias) => Blade::component($alias, $component['class'], $prefix)
//        );
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'form-components');

        $this->app->singleton(FormDataBinder::class, fn () => new FormDataBinder);
    }
}
