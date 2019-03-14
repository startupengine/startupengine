<?php

namespace App\Traits;

trait hasJsonSchema
{
    public function getModel()
    {
        return get_class($this);
    }
}
