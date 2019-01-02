<?php

namespace App;

use App\Traits\IsApiResource;
use App\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Appstract\Meta\Metable;
use \Conner\Tagging\Taggable;
use NexusPoint\Versioned\Versioned;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Carbon\Carbon;


class Post extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use \Altek\Accountant\Recordable;

    use SoftDeletes;

    use EloquentJoin;

    //use Auditable;

    use Metable;

    use Taggable;

    use Versioned;

    use RelationshipsTrait;

    use IsApiResource;

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

    protected $fillable = ['json', 'excerpt'];

    public function searchFields()
    {
        return ['json', 'title', 'slug'];
    }

    /*
    protected $casts = [
        'json' => 'json',
    ];
    */

    public function setJsonAttribute($json)
    {
        $this->attributes['json'] = json_encode($json);
    }

    public function bodyHtml()
    {
        return Markdown::convertToHtml($this->content()->body->body);
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

    public function markdown($content)
    {
        return Markdown::convertToHtml($content);
    }

    public function category()
    {
        $category = \App\Category::where('id', '=', $this->category_id)->first();
        return $category;
    }

    public function thumbnail()
    {
        if ($this->content() != null) {
            if ($this->content() != null && isset($this->content()->sections)) {
                foreach ($this->schema()->sections as $section) {
                    if ($section->fields != null) {
                        foreach ($section->fields as $field => $value) {

                            if (isset($value->isThumbnail) && $value->isThumbnail == true) {
                                $slug = $section->slug;
                                $string = "sections->" . $slug . "->fields->" . $field;

                                if ($this->content()->sections->$slug->fields->$field) {
                                    return $this->content()->sections->$slug->fields->$field;
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

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/post.json');
        $baseSchema = json_decode($path, true);

        if($this->postType() != null OR $this->json == null) {
            $postTypeSchema = json_decode($this->postType()->first()->json, true);

            $merged = array_merge($postTypeSchema, $baseSchema);

            $merged = json_decode(json_encode($merged));
        }
        else {
            $merged = $baseSchema;
        }
        //dd($merged);
        return $merged;
    }

    public function postType()
    {
        return $this->hasOne('App\PostType', 'slug', 'post_type');

    }

    public function thumbnailField($fullString = false)
    {

        if ($this->schema() != null && isset($this->schema()->sections)) {
            foreach ($this->schema()->sections as $section) {
                if ($section->fields != null) {
                    foreach ($section->fields as $field => $value) {

                        if (isset($value->isThumbnail) && $value->isThumbnail == true) {
                            $slug = $section->slug;
                            $string = "sections->" . $slug . "->fields->" . $field;
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

    public function sectionHasContent($sectionName, $fieldsToExclude = [], $returnFields = false)
    {
        if (isset($this->schema()->sections->$sectionName) && isset($this->content()->sections->$sectionName)) {
            $section = $this->schema()->sections->$sectionName;
            $fieldsWithContent = [];
            foreach ($section->fields as $field => $value) {
                $slug = $section->slug;

                if (isset($this->content()->sections->$slug->fields->$field)) {
                    if (in_array($field, $fieldsToExclude)) {
                    } else {
                        $fieldsWithContent[$field] = $this->content()->sections->$slug->fields->$field;
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
    }

    public function excerpt()
    {
        if ($this->content() != null && isset($this->schema()->fields)) {
            foreach ($this->schema()->fields as $field => $value) {
                if (isset($value->isExcerpt) && $value->isExcerpt == true) {
                    if ($this->$field) {
                        return $this->$field;
                    } else {
                        return null;
                    }
                }
            }
            foreach ($this->schema()->sections as $section) {
                if ($section->fields != null) {
                    foreach ($section->fields as $field => $value) {
                        dd($section->fields);
                        if (isset($value->isExcerpt) && $value->isExcerpt == true) {

                            $slug = $section->slug;
                            $string = "sections->" . $slug . "->fields->" . $field;
                            if ($this->content()->sections->$slug->fields->$field) {
                                return $this->content()->sections->$slug->fields->$field;
                            } else {
                                return null;
                            }

                        }
                    }
                }
            }
        }
    }

    public function background()
    {
        $background = $this->content()->body->background;
        if ($background !== null) {
            return $background;
        } elseif ($this->image() !== null) {
            $background = $this->image();
            return $background;
        } else {
            return null;
        }
    }

    public function image()
    {
        $image = $this->content()->body->image;
        if ($image !== null) {
            return $image;
        } else {
            return null;
        }
    }

    public function videoType($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'author_id')->withDefault(function ($user) {
            $user->id = 'User ID';
        });
    }

    public function primaryTag()
    {
        $tags = $this->tagNames();
        if ($tags !== null && count($tags) !== 0) {
            $primaryTag = $tags[0];
            $tag = \App\Post::where('post_type', '=', 'tag')->where('slug', '=', strtolower($primaryTag))->first();
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
        $views = $this->hasMany('App\AnalyticEvent', 'model_id')->where('event_type', '=', 'content viewed')->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
        return $views;
    }

}
