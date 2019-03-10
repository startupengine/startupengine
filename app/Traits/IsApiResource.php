<?php

namespace App\Traits;

use Symfony\Component\PropertyAccess\PropertyAccess;

trait IsApiResource
{
    public function overRideEdit()
    {
        return false;
    }

    public function postSave()
    {
        return false;
    }

    public function links($array = [])
    {
        $modelType = strtolower(substr(strrchr(get_class($this), "\\"), 1));

        $selected = array_intersect($array, ['self', 'related']);

        if (count($array) > 0) {
            $results = [];
            if (in_array('self', $selected)) {
                $results['self'] =
                    url('/') .
                    '/api/resources/' .
                    modelToPath($modelType) .
                    '/' .
                    $this->id;
            }
            if (in_array('related', $selected)) {
                $results['related'] =
                    url('/') . '/api/resources/' . modelToPath($modelType);
            }
            return $results;
        } else {
            return [
                'self' =>
                    url('/') .
                        '/api/resources/' .
                        modelToPath($modelType) .
                        '/' .
                        $this->id,
                'related' =>
                    url('/') . '/api/resources/' . modelToPath($modelType)
            ];
        }
    }

    public function getJsonContent($field)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()->getPropertyAccessor();
        $value = null;
        if ($this->json != null) {
            $json = json_decode($this->json, true);
            if ($json != null) {
                $value = $propertyAccessor->getValue($json, $field);
            }
        }
        return $value;
    }

    public function getPluralName()
    {
        $schema = $this->schema();
        $term = null;
        if (isset($schema->lang->en->plural)) {
            $term = $schema->lang->en->plural;
        } elseif (isset($schema->lang->en->singular)) {
            $term = str_plural($schema->lang->en->singular);
        } elseif (isset($this->title)) {
            $term = str_plural($this->title);
        }

        return $term;
    }
}
