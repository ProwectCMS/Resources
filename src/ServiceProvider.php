<?php

namespace ProwectCMS\Resources;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use ProwectCMS\Resources\Facades\Field;
use ProwectCMS\Resources\Fields\FieldManager;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        // Register Field Facade
        $this->app->bind('field', function ($app) {
            return new FieldManager();
        });
    }

    public function boot()
    {
        
    }
}