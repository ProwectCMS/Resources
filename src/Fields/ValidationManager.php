<?php

namespace ProwectCMS\Resources\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ValidationManager
{
    protected FieldDefinition $fieldDefinition;
    protected Model $model;

    public function __construct(FieldDefinition $fieldDefinition)
    {
        $this->fieldDefinition = $fieldDefinition;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getCreationValidationRules()
    {
        $rules = [];
        foreach ($this->fieldDefinition->fields() as $field) {
            $rules[$field->getName()] = $this->parseRules($field->getCreationValidationRules());
        }

        return $rules;
    }

    public function getUpdateValidationRules()
    {
        $rules = [];
        foreach ($this->fieldDefinition->fields() as $field) {
            $rules[$field->getName()] = $this->parseRules($field->getUpdateValidationRules());
        }

        return $rules;
    }

    public function getReplaceMap()
    {
        $map = [];
        if (isset($this->model)) {
            $modelData = $this->model->toArray();
            foreach (Arr::dot($modelData) as $key => $value) {
                $map["model.$key"] = $value;
            }
        }

        return $map;
    }

    protected function parseRules(array $rules)
    {
        if (isset($this->model)) {
            for ($i = 0; $i < count($rules); $i++) {
                foreach ($this->getReplaceMap() as $key => $value) {
                    $rules[$i] = str_replace('{' . $key . '}', $value, $rules[$i]); // you can access model attributes using "{model.attribute}", f.e. exists:users,email,{model.id}
                };
            }
        }

        return $rules;
    }
}