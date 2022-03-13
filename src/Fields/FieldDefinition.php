<?php

namespace ProwectCMS\Resources\Fields;

class FieldDefinition
{
    protected $fields = [];

    public static function make() : self
    {
        return new static;
    }

    public function add(IField $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    public function fields()
    {
        return $this->fields;
    }
}