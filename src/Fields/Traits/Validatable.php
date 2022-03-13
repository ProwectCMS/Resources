<?php

namespace ProwectCMS\Resources\Fields\Traits;

trait Validatable
{
    protected array $rules = [];
    protected array $createRules = [];
    protected array $updateRules = [];

    public function rules(...$rules)
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    public function createRules(...$rules)
    {
        $this->createRules = array_merge($this->createRules, $rules);

        return $this;
    }

    public function updateRules(...$rules)
    {
        $this->updateRules = array_merge($this->updateRules, $rules);

        return $this;
    }

    public function getCreationValidationRules()
    {
        return array_merge($this->rules, $this->createRules);
    }

    public function getUpdateValidationRules()
    {
        return array_merge($this->rules, $this->updateRules);
    }
}