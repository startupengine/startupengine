<?php

namespace App\Traits;

trait hasJsonSchema
{
    public function getModel()
    {
        return get_class($this);
    }

    public function schema()
    {
        if ($this->getModel() == 'App\Page') {
            $path = file_get_contents(storage_path() . '/schemas/page.json');
            $baseSchema = json_decode($path, true);

            if ($this->schema != null) {
                $postTypeSchema = json_decode($this->schema, true);

                $merged = array_merge($postTypeSchema, $baseSchema);

                $merged = json_decode(json_encode($merged));
            } else {
                $merged = $baseSchema;
            }

            $schema = $merged;

            return $schema;
        }
        if ($this->getModel() == 'App\Post') {
        }
        if ($this->getModel() == 'App\Product') {
        }
        if ($this->getModel() == 'App\Plan') {
        }
        if ($this->getModel() == 'App\User') {
        }
        if ($this->getModel() == 'App\Subscription') {
        } else {
            return null;
        }
    }
}
