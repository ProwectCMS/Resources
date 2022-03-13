<?php

namespace ProwectCMS\Resources\Tests;

use Illuminate\Support\Facades\DB;
use ProwectCMS\Resources\Tests\Unit\TestModel;

class Database
{
    public function setup()
    {
        DB::statement('DROP TABLE IF EXISTS test_models;');
        DB::statement('CREATE TABLE test_models (
            id              INT PRIMARY KEY,
            title           VARCHAR(30) NOT NULL,
            description     TEXT NULL,
            created_at      TIMESTAMP,
            updated_at      TIMESTAMP    
        );');

        TestModel::create([
            'id' => 1,
            'title' => 'This is the first',
            'description' => 'Lorem ipsum dolor sit amet'
        ]);

        TestModel::create([
            'id' => 2,
            'title' => 'This is the second'
        ]);
    }
}