<?php

namespace ProwectCMS\Resources\Tests\Unit\Field\Type;

use ProwectCMS\Resources\Fields\Types\Text;
use ProwectCMS\Resources\Tests\TestCase;

class TextFieldTest extends TestCase
{
    public function testFieldCreation()
    {
        $field = new Text();
        $field->name('test');
        $field->label('My Test Field');
        $field->value(123);

        $this->assertInstanceOf(Text::class, $field);
        $this->assertEquals('test', $field->getName());
    }
}