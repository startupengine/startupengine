<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Appstract\Meta\Metable;
use \Conner\Tagging\Taggable;
use NexusPoint\Versioned\Versioned;


class Post extends Model implements AuditableContract
{
    use SoftDeletes;

    use Auditable;

    use Metable;

    use Taggable;

    use Versioned;

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

    public function bodyHtml()
    {
        return Markdown::convertToHtml($this->content()->body->body);
    }

    public function markdown($content)
    {
        return Markdown::convertToHtml($content);
    }

    public function category() {
        $category = \App\Category::where('id', '=', $this->category_id)->first();
        return $category;
    }

    public function json()
    {
        $json = $this->json;
        return json_decode($json);
    }

    public function content()
    {
        $json = $this->json;
        $array = json_decode($json, true)['versions'][1];
        return json_decode(json_encode($array));
    }

    public function image() {
        $image = $this->content()->body->image;
        if($image !== null ) {
            return $image;
        }
        else {
            return null;
        }
    }

    public function background() {
        $background = $this->content()->body->background;
        if($background !== null ) {
            return $background;
        }
        elseif($this->image() !== null) {
            $background = $this->image();
            return $background;
        }
        else {
            return null;
        }
    }

    public function postType() {
        $postType = $this->post_type;
        $postType = PostType::where('slug', '=', $postType)->firstOrFail();
        return $postType;
    }

    public function schema() {
        return json_decode($this->postType()->json);
    }

    public function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    public function user(){
        $user = \App\User::where('id', '=', $this->author_id)->first();
        if($user !== null) {
            return $user;
        }
        else {
            return null;
        }
    }

    public function primaryTag(){
        $tags = $this->tagNames();
        if($tags !== null && count($tags) !== 0) {
            $primaryTag = $tags[0];
            $tag = \App\Post::where('post_type', '=', 'tag')->where('slug','=',strtolower($primaryTag))->first();
            return $tag;
        }
        else {
            return null;
        }
    }

    public function views(){
        return \App\AnalyticEvent::where("event_data->model", 'post')->where("event_data->id", $this->id)->get();
    }

}
