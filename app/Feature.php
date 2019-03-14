<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use NexusPoint\Versioned\Versioned;
use App\Traits\RelationshipsTrait;
use App\Traits\IsApiResource;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use App\Scopes\GlobalFeaturesScope;

class Feature extends Model
{
    //use \Altek\Accountant\Recordable;

    use SoftDeletes;

    use EloquentJoin;

    //use Auditable;

    use Taggable;

    //use Versioned;

    use RelationshipsTrait;

    use IsApiResource;

    protected $fillable = ['name', 'json', 'excerpt'];

    protected $casts = ["json" => "string"];

    /**
     * Field from the model to use as the versions name
     * @var string
     */
    protected $versionNameColumn = 'title';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalFeaturesScope());
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class);
    }

    public function searchFields()
    {
        return ['json', 'title', 'slug'];
    }

    public function setJsonAttribute($json)
    {
        $this->attributes['json'] = json_encode($json);
    }

    public function content()
    {
        $json = $this->json();
        if ($json !== null) {
            return $json;
        } else {
            return null;
        }
    }

    public function json()
    {
        if (isset($this->json)) {
            $json = $this->json;
        } else {
            $json = null;
        }
        if (gettype($this->json) == 'string') {
            $this->json = json_decode($this->json);
        }
        return json_decode($json);
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/feature.json');
        $baseSchema = json_decode($path);
        return $baseSchema;
    }

    public function primaryTag()
    {
        $tags = $this->tagNames();
        if ($tags !== null && count($tags) !== 0) {
            $primaryTag = $tags[0];
            $tag = \App\Post::where('post_type', '=', 'tag')
                ->where('slug', '=', strtolower($primaryTag))
                ->first();
            return $tag;
        } else {
            return null;
        }
    }

    public function views()
    {
        $request = request();
        if ($request->input('startDate') != null) {
            $startDate = \Carbon\Carbon::parse($request->input('startDate'));
        } else {
            $startDate = new Carbon();
            $startDate = $startDate->subDays(30);
        }
        if ($request->input('endDate') != null) {
            $endDate = \Carbon\Carbon::parse($request->input('endDate'));
        } else {
            $endDate = new Carbon();
        }
        $views = $this->hasMany(\App\AnalyticEvent::class, 'model_id')
            ->where('event_type', '=', 'content viewed')
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate);
        return $views;
    }

    public function transformations()
    {
        return null;
    }
}
