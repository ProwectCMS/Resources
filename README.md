# ProwectCMS Resources

Laravel Resources & API Builder based on [spatie/laravel-query-builder](https://spatie.be/docs/laravel-query-builder/v5/introduction)

## Installation

```bash
composer require prowetcms/resources
```

## Usage

**Sample Repository:**

```php
<?php

namespace App\Repositories;

use App\Models\User;
use ProwectCMS\Resources\Repository;
use ProwectCMS\Resources\Fields\FieldDefinition;
use ProwectCMS\Resources\Facades\Field;

class UserRepository extends Repository
{
    public function getModelClass()
    {
        return User::class;
    }

    public function getFieldDefinition() : FieldDefinition
    {
        return (new FieldDefinition)
            ->add(Field::make('id', ['name' => 'id']))
            ->add(Field::make('text', ['name' => 'name'])->rules('required'))
            ->add(Field::make('email', ['name' => 'email']))
        ;
    }
}
```

**Sample Controller:**

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use ProwectCMS\Resources\Http\Controllers\ApiResourceController;
use ProwectCMS\Resources\Repository;

class UserController extends ApiResourceController
{
    protected function getRepository() : Repository
    {
        return new UserRepository();
    }
}
```

**Sample Routes:**

```php
Route::apiResource('users', UserController::class);
```