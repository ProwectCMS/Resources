<?php

namespace ProwectCMS\Resources\Tests\Unit\Field\FieldDefinition;

use ProwectCMS\Resources\Facades\Field;
use ProwectCMS\Resources\Fields\Types\Text;
use ProwectCMS\Resources\Fields\FieldDefinition;
use ProwectCMS\Resources\Tests\TestCase;

class FieldDefinitionTest extends TestCase
{
    public function testFieldDefinitionCreation()
    {
        $fieldDefinition = FieldDefinition::make()
            ->add(
                Field::make('text')
                    ->label('Name')
                    ->name('name')
            )
            ->add(
                Field::make('text', ['name' => 'test'])
            )
            ->add(
                new Text(name: 'remarks')
            )
            ;

        $this->assertCount(3, $fieldDefinition->fields());
    }
}