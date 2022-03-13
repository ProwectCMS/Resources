<?php

namespace ProwectCMS\Resources;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use ProwectCMS\Resources\Fields\FieldDefinition;
use ProwectCMS\Resources\Fields\ValidationManager;

abstract class Repository
{
    abstract public function getModelClass();

    abstract public function getFieldDefinition() : FieldDefinition;

    public function getQueryBuilder($query = null) : QueryBuilder
    {
        $queryBuilder = QueryBuilder::for($query ? $query : $this->getModelClass());

        $queryBuilder->applyFieldDefinition($this->getFieldDefinition());

        return $queryBuilder;
    }

    public function create(array $data)
    {
        $fieldDefinition = $this->getFieldDefinition();

        $validationManager = new ValidationManager($fieldDefinition);
        $validationRules = $validationManager->getCreationValidationRules();

        $validator = Validator::make($data, $validationRules);
        $validator->validate();

        $model = new ($this->getModelClass());
        $model->fill($data);
        $model->save();

        return $model;
    }

    protected function checkModel(Model $model)
    {
        $modelClass = $this->getModelClass();
        if (!$model instanceof $modelClass) {
            throw new Exception('Invalid model: ' . get_class($model) . ' for repository: ' . get_called_class());
        }
    }

    public function update(Model $model, array $data)
    {
        $this->checkModel($model);

        $fieldDefinition = $this->getFieldDefinition();

        $validationManager = new ValidationManager($fieldDefinition);
        $validationManager->setModel($model);
        $validationRules = $validationManager->getUpdateValidationRules();

        $validator = Validator::make($data, $validationRules);
        $validator->validate();

        $model->fill($data);
        $model->save();
    }

    public function destroy(Model $model)
    {
        $this->checkModel($model);

        $model->delete();
    }
}