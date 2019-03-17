<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use App\Traits\RelationshipsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Altek\Accountant\Recordable as Recordable;

class Promo extends Model
{
    use RelationshipsTrait;

    use EloquentJoin;

    use Taggable;

    use SoftDeletes;

    use IsApiResource;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $useTableAlias = false;
    protected $appendRelationsCount = false;
    protected $leftJoin = false;
    protected $aggregateMethod = 'MAX';

    protected $guarded = [];
    protected $fillable = ['name', 'slug', 'json', 'status'];

    public function json()
    {
        if ($this->json != null) {
            $json = json_decode($this->json);
        } else {
            $json = null;
        }
        return $json;
    }

    public function features()
    {
        return $this->belongsToMany(\App\Feature::class);
    }

    public function posts()
    {
        return $this->belongsToMany(\App\Post::class);
    }

    public function transformations()
    {
        return null;
    }

    public function searchFields()
    {
        return ['slug', 'name', 'description', 'json'];
    }

    public function thumbnail()
    {
        if ($this->schema() != null && $this->schema()->sections != null) {
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
                            //dd($this->content()->sections->$slug->fields->$field);
                            if (
                                $this->content() != null &&
                                isset($this->content()->sections) &&
                                ($this->content()->sections->$slug != null or
                                    isset($this->content()->sections->$slug)) &&
                                isset(
                                    $this->content()->sections->$slug->fields
                                ) &&
                                isset(
                                    $this->content()->sections->$slug->fields
                                        ->$field
                                )
                            ) {
                                return $this->content()->sections->$slug->fields
                                    ->$field;
                            } else {
                                return null;
                            }
                        }
                    }
                }
            }
        }
    }

    public function content()
    {
        $json = $this->json;

        if (gettype($json) == 'string') {
            $json = json_decode($json, true);
        }
        if (gettype($json) == 'object' or gettype($json) == 'array') {
            $json = json_decode(json_encode($json));
        }
        return $json;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/cta.json');
        $schema = json_decode($path);
        return $schema;
    }
}
