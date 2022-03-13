<?php

namespace ProwectCMS\Resources\Tests\Unit\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use ProwectCMS\Resources\Tests\TestCase;
use ProwectCMS\Resources\Tests\Unit\TestModel;
use ProwectCMS\Resources\Tests\Unit\TestModelController;

class ApiResourceControllerTest extends TestCase
{
    const CONTROLLER = TestModelController::class;

    protected function action($controllerAction, array $params = [])
    {
        return app()->call(static::CONTROLLER . '@' . $controllerAction, $params);
    }

    public function testIndexAction()
    {
        $response = $this->action('index');

        $this->assertInstanceOf(LengthAwarePaginator::class, $response);
        $collection = $response->getCollection();
        $this->assertCount(2, $collection);
    }

    public function testStoreAction()
    {
        $request = new Request([
            'title' => 'UnitTest',
            'description' => 'This was created by an unit test'
        ]);

        $response = $this->action('store', ['request' => $request]);
        $this->assertInstanceOf(TestModel::class, $response);
    }

    public function testShowAction()
    {
        $response = $this->action('show', ['modelIdentifier' => 1]);
        $this->assertInstanceOf(TestModel::class, $response);
    }

    public function testUpdateAction()
    {
        $request = new Request([
            'title' => 'This was updated by an unit test'
        ]);

        $response = $this->action('update', ['modelIdentifier' => 2, 'request' => $request]);
        $this->assertInstanceOf(TestModel::class, $response);
    }

    public function testDestroyAction()
    {
        $response = $this->action('destroy', ['modelIdentifier' => 2]);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }
}