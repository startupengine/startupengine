<?php

namespace App\Traits;

trait IsApiResource
{

    public function overRideEdit(){
        return false;
    }

    public function links($array = [])
    {

        $modelType = strtolower(substr(strrchr(get_class($this), "\\"), 1));

        $selected = array_intersect($array, ['self', 'related']);

        if(count($array) > 0){
            $results = [];
            if(in_array('self',$selected)) {
                $results['self'] = url('/') . '/api/resources/' . modelToPath($modelType) . '/' . $this->id;
            }
            if(in_array('related',$selected)) {
                $results['related'] =url('/') . '/api/resources/' . modelToPath($modelType);
            }
            return $results;
        }

        else {
            return [
                'self' => url('/') . '/api/resources/' . modelToPath($modelType) . '/' . $this->id,
                'related' => url('/') . '/api/resources/' . modelToPath($modelType)
            ];
        }
    }
}