<?php

namespace Administr\Filters;

use Illuminate\Support\ServiceProvider;

class FiltersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'administr/filters');
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/administr/filters')
        ], 'views');

        $this->publishes([
            __DIR__ . '/Config/administr.filters.php' => config_path('administr.filters.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/administr.filters.php', 'administr.filters');
    }
}