<?php

namespace ProwectCMS\Resources;

use ProwectCMS\Resources\Fields\FieldDefinition;
use Spatie\QueryBuilder\QueryBuilder as BaseQueryBuilder;

class QueryBuilder extends BaseQueryBuilder
{
    public function applyFieldDefinition(FieldDefinition $fieldDefinition)
    {
        $allowedFields = [];
        $sortableFields = [];

        foreach ($fieldDefinition->fields() as $field) {
            $allowedFields[] = $field->getName();

            if ($field->sortable) {
                $sortableFields[] = $field->getName();
            }
        }

        $this->allowedFields($allowedFields);
        $this->allowedSorts($sortableFields);

        // TODO: includes (relationships)

    }
}