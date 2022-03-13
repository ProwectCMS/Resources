<?php

namespace ProwectCMS\Resources\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

abstract class ApiResourceController extends Controller
{
    use ApiControllerTrait;

    public function index(Request $request)
    {
        return $this->getAllPaginated()
            ->appends($request->query());
    }

    public function store(Request $request)
    {
        return $this->getRepository()
            ->create($request->all());
    }

    public function show($modelIdentifier)
    {
        $model = $this->getModel($modelIdentifier);

        return $this->getSingle($model);
    }

    public function update($modelIdentifier, Request $request)
    {
        $model = $this->getModel($modelIdentifier);

        $this->getRepository()
            ->update($model, $request->all());

        return $this->getSingle($model);
    }

    public function destroy($modelIdentifier)
    {
        $model = $this->getModel($modelIdentifier);

        $this->getRepository()
            ->destroy($model);

        return response(null, 204);
    }
}