<?php

namespace App\Traits;

use Hashids\Hashids;
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

    public function getHashId()
    {
        $hashids = new Hashids();
        return $hashids->encode($this->id);
    }

    public function decodeHashId($id)
    {
        $hashids = new Hashids();
        return $hashids->decode($id);
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
            if (modelToPath($modelType) == 'content') {
                $publicId = $this->getHashId();
            } else {
                $publicId = $this->id;
            }
            return [
                'self' =>
                    url('/') .
                        '/api/resources/' .
                        modelToPath($modelType) .
                        '/' .
                        $publicId,
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

    public function getJsonSchemaContent($field)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()->getPropertyAccessor();
        $value = null;
        if ($this->json != null) {
            $json = json_decode($this->schema, true);
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

    public function thumbnail()
    {
        if ($this->content() != null) {
            if ($this->content() != null && isset($this->content()->sections)) {
                foreach ($this->schema()->sections as $section) {
                    if ($section->fields != null) {
                        foreach ($section->fields as $field => $value) {
                            if (
                                isset($value->isThumbnail) &&
                                $value->isThumbnail == true
                            ) {
                                $slug = $section->slug;

                                $contentstring =
                                    '[sections][' .
                                    $slug .
                                    '][fields][' .
                                    $field .
                                    ']';
                                if (
                                    $this->getJsonContent($contentstring) !=
                                    null
                                ) {
                                    return $this->getJsonContent(
                                        $contentstring
                                    );
                                } else {
                                    return null;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function transformations($input = null)
    {
        return null;
    }

    public function addAnalyticEvent($type = 'viewed', $json = null)
    {
        $event = new \App\AnalyticEvent();
        if (\Auth::user() != null) {
            $event->user_email = \Auth::user()->email;
            $event->user_id = \Auth::user()->id;
            $event->user_name = \Auth::user()->name;
        }
        if ($json != null) {
            if (gettype($json) == 'string') {
                $json = json_decode($json);
            }
            $event->event_data = $json;
        }
        $agent = request()->header('User-Agent');
        $session = \Session::getId();
        $primaryKey = $this->primaryKey;
        $event->user_agent = $agent;
        $event->fingerprint = request()->fingerprint();
        $event->script_name = __FILE__;
        $event->model_class = get_class($this);
        $event->full_url = request()->fullUrl();
        $event->request_uri = request()->getUri();
        $event->decoded_path = request()->decodedPath();
        $event->base_path = request()->getBasePath();
        $event->scheme = request()->getScheme();
        $event->scheme_and_host = request()->getSchemeAndHttpHost();
        $event->session_id = $session;
        $event->model_id = $this->$primaryKey;
        $event->event_type = $type;
        $event->client_ip = request()->ip();
        $event->client_locale = request()->getLocale();
        $event->save();
    }

    public function thumbnailField($fullString = false)
    {
        if ($this->schema() != null && isset($this->schema()->sections)) {
            foreach ($this->schema()->sections as $section) {
                if ($section->fields != null) {
                    foreach ($section->fields as $field => $value) {
                        if (
                            isset($value->isThumbnail) &&
                            $value->isThumbnail == true
                        ) {
                            $slug = $section->slug;
                            $string =
                                "sections->" . $slug . "->fields->" . $field;
                            if ($fullString == true) {
                                return $string;
                            } else {
                                return $field;
                            }
                        }
                    }
                }
            }
        }
    }

    public function standardSchema()
    {
        return $this->schema();
    }

    public function sectionHasContent(
        $sectionName,
        $fieldsToExclude = [],
        $returnFields = false
    ) {
        $result = $this->getJsonContent('[sections][' . $sectionName . ']');
        if ($result == null) {
            return false;
        } else {
            return true;
        }
        /*
        if (
            isset($this->schema()->sections->$sectionName) &&
            isset($this->content()->sections->$sectionName)
        ) {
            $section = $this->schema()->sections->$sectionName;
            $fieldsWithContent = [];
            foreach ($section->fields as $field => $value) {
                $slug = $section->slug;

                if (isset($this->content()->sections->$slug->fields->$field)) {
                    if (in_array($field, $fieldsToExclude)) {
                    } else {
                        $fieldsWithContent[
                            $field
                        ] = $this->content()->sections->$slug->fields->$field;
                    }
                }
            }
            if ($returnFields == true) {
                return $fieldsWithContent;
            } else {
                if (count($fieldsWithContent) > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        */
    }
}
