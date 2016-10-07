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
    }

    public function register()
    {
    }
}