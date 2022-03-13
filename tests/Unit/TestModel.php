<?php

namespace ProwectCMS\Resources\Tests\Unit;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = 'test_models';

    protected $fillable = [
        'id', 'title', 'description'
    ];
}