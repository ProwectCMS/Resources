<?php

namespace ProwectCMS\Resources\Http\Controllers;

use ProwectCMS\Resources\Repository;

trait ApiControllerTrait
{
    abstract protected function getRepository() : Repository;

    protected function getModel($identifier = null)
    {
        $model = new ($this->getRepository()->getModelClass());

        if ($identifier) {
            $routeKeyName = $model->getRouteKeyName();

            return $model::query()
                ->where($routeKeyName, $identifier)
                ->firstOrFail();
        }

        return $model;
    }

    protected function getAllPaginated($limit = 25)
    {
        return $this->getRepository()
            ->getQueryBuilder()
            ->paginate($limit);
    }

    protected function getSingle($queryOrModel)
    {
        return $this->getRepository()
            ->getQueryBuilder($queryOrModel)
            ->first();
    }
}