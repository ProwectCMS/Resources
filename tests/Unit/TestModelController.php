<?php

namespace ProwectCMS\Resources\Tests\Unit;

use ProwectCMS\Resources\Http\Controllers\ApiResourceController;
use ProwectCMS\Resources\Repository;

class TestModelController extends ApiResourceController
{
    protected function getRepository(): Repository
    {
        return new TestModelRepository();
    }
}