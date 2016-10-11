<?php

namespace Administr\ListView\Filters;

use Illuminate\Support\ServiceProvider;

class ListViewFiltersServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'administr/listview-filters');
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/administr/listview-filters')
        ], 'views');

        $this->publishes([
            __DIR__ . '/Config/administr.listview-filters.php' => config_path('administr.listview-filters.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/administr.listview-filters.php', 'administr.listview-filters');
    }
}