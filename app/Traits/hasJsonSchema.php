<?php

namespace App\Traits;

trait hasJsonSchema
{

    public function getModel() {
        return get_class($this);
    }

    public function schema() {
        if($this->getModel() == 'App\Page') {
            if ($this->schema !== null) {
                $schema = json_decode($this->schema);
                if (gettype($schema) == "string") {
                    $schema = json_decode($schema);
                }
            }
            if(!isset($schema)) {
                $path = file_get_contents(storage_path().'/schemas/page.json');
                $schema = json_decode($path);
            }

            return $schema;
        }
        if($this->getModel() == 'App\Post') {

        }
        if($this->getModel() == 'App\Product') {

        }
        if($this->getModel() == 'App\Plan') {

        }
        if($this->getModel() == 'App\User') {

        }
        if($this->getModel() == 'App\Subscription') {

        }
        else {
            return null;
        }
    }

}