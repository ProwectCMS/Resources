<?php

namespace ProwectCMS\Resources\Tests\Unit\Field\Validation;

use ProwectCMS\Resources\Fields\ValidationManager;
use ProwectCMS\Resources\Tests\TestCase;
use ProwectCMS\Resources\Tests\Unit\TestModel;
use ProwectCMS\Resources\Tests\Unit\TestModelRepository;

class ValdiationManagerTest extends TestCase
{
    public function testReplaceMap()
    {
        $model = new TestModel();
        $model->fill([
            'title' => 'Test123',
            'description' => 'BlaBlub'
        ]);
        $model->save();

        $validationManager = new ValidationManager((new TestModelRepository)->getFieldDefinition());
        $validationManager->setModel($model);
        $replaceMap = $validationManager->getReplaceMap();

        $this->assertArrayHasKey('model.title', $replaceMap);
        $this->assertEquals($replaceMap['model.title'], 'Test123');

        $this->assertArrayHasKey('model.description', $replaceMap);
        $this->assertEquals($replaceMap['model.description'], 'BlaBlub');
    }
}