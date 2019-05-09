<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use NexusPoint\Versioned\Versioned;
use App\Traits\IsApiResource;

class PostType extends Model
{
    use SoftDeletes;

    //use Versioned;

    use IsApiResource;

    protected $fillable = ['slug', 'title', 'enabled'];

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

    protected $dates = ['deleted_at', 'published_at'];

    public function json()
    {
        if (isset($this->json)) {
            $json = json_decode($this->json);
        } else {
            $json = null;
        }
        return $json;
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'post_type', 'slug');
    }

    public function schema()
    {
        $postTypeSchema = json_decode($this->json);
        return $postTypeSchema;
    }
}
