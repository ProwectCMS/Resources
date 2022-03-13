<?php

namespace ProwectCMS\Resources\Fields;

use ProwectCMS\Resources\Fields\Traits\Sortable;
use ProwectCMS\Resources\Fields\Traits\Validatable;

abstract class AField implements IField
{
    use Validatable, Sortable;

    public function __construct(
        protected $name = null, 
        protected $label = null, 
        protected $value = null
    ) {}

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    public function toArray()
    {
        return [
            'type' => $this->getType(),
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value
        ];
    }

    public function toJson($flags = 0)
    {
        return json_encode($this->toArray(), $flags);
    }

    public function __toString()
    {
        return $this->toJson(JSON_PRETTY_PRINT);
    }

    public function getName()
    {
        return $this->name;
    }
}