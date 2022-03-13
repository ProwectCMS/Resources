<?php

namespace ProwectCMS\Resources\Fields\Types;

class Email extends Text
{
    protected array $rules = ['email'];

    public function getType()
    {
        return 'email';
    }
}