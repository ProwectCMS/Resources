<?php

namespace ProwectCMS\Resources\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use ProwectCMS\Resources\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilderServiceProvider;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $database = new Database();
        $database->setup();
    }

    protected function getPackageProviders($app)
    {
        return [
            QueryBuilderServiceProvider::class,
            ServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
