<?php

namespace ProwectCMS\Resources\Tests\Unit;

use ProwectCMS\Resources\Facades\Field;
use ProwectCMS\Resources\Fields\FieldDefinition;
use ProwectCMS\Resources\Fields\Types\Text;
use ProwectCMS\Resources\Repository;

class TestModelRepository extends Repository
{
    public function getModelClass()
    {
        return TestModel::class;
    }

    public function getFieldDefinition(): FieldDefinition
    {
        $fieldDefinition = new FieldDefinition();
        $fieldDefinition->add(
            (new Text(name: 'title', label: 'Title'))->rules('required')
        );
        $fieldDefinition->add(Field::make('textarea')->name('description')->label('Description'));

        return $fieldDefinition;
    }
}