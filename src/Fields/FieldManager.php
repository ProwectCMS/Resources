<?php

namespace ProwectCMS\Resources\Fields;

use Exception;
use ProwectCMS\Resources\Fields\Types\Email;
use ProwectCMS\Resources\Fields\Types\ID;
use ProwectCMS\Resources\Fields\Types\Text;
use ProwectCMS\Resources\Fields\Types\Textarea;

class FieldManager
{
    protected $fields = [
        'email' => Email::class,
        'id' => ID::class,
        'text' => Text::class,
        'textarea' => Textarea::class,
    ];

    public function registerFieldType($name, $fieldTypeClass) : void
    {
        $requiredInterface = IField::class;
        $interfaces = class_implements($fieldTypeClass);

        if (!isset($interfaces[$requiredInterface])) {
            throw new Exception("$fieldTypeClass needs to implement " . $requiredInterface);
        }

        if (isset($this->fields[$name])) {
            throw new Exception("$name is already a registered field");
        }

        if (!in_array($fieldTypeClass, $this->fields)) {
            $this->fields[$name] = $fieldTypeClass;
        }
    }

    public function make($name, array $parameters = [])
    {
        if (!isset($this->fields[$name])) {
            throw new Exception("Field $name was not found - maybe it is not registered?");
        }

        return new $this->fields[$name](...$parameters);
    }
}