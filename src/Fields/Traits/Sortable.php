<?php

namespace ProwectCMS\Resources\Fields\Traits;

trait Sortable
{
    public bool $sortable = false;

    public function sortable()
    {
        $this->sortable = true;
    }
}