<?php

namespace ProwectCMS\Resources\Facades;

use Illuminate\Support\Facades\Facade;

class Field extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'field';
    }
}