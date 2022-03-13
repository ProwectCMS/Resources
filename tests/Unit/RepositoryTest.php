<?php

namespace ProwectCMS\Resources\Tests\Unit;

use Illuminate\Validation\ValidationException;
use ProwectCMS\Resources\Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function testCreateModel()
    {
        $repository = new TestModelRepository();
        $model = $repository->create([
            'title' => 'Test',
            'description' => 'Lorem ipsum dolor sit amet'
        ]);

        $this->assertInstanceOf(TestModel::class, $model);
        $this->assertEquals('Test', $model->title);
        $this->assertEquals('Lorem ipsum dolor sit amet', $model->description);
    }

    public function testCreateModelWithValidationFailure()
    {
        $this->expectException(ValidationException::class);

        $repository = new TestModelRepository();
        $repository->create([
            'title' => null
        ]);
    }

    public function testUpdateModel()
    {
        $model = new TestModel();
        $model->fill([
            'title' => 'Test',
            'description' => 'Lorem ipsum dolor sit amet'
        ]);
        $model->save();

        $repository = new TestModelRepository();
        $repository->update($model, [
            'title' => 'Hello world!'
        ]);

        $this->assertEquals('Hello world!', $model->title);
    }

    public function testUpdateModelWithValidationFailure()
    {
        $this->expectException(ValidationException::class);

        $model = new TestModel();
        $model->fill([
            'title' => 'Test',
            'description' => 'Lorem ipsum dolor sit amet'
        ]);
        $model->save();

        $repository = new TestModelRepository();
        $repository->update($model, [
            'title' => null
        ]);
    }
}