<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tagging_tags';

    public function content()
    {
        $post = \App\Post::where('slug', '=', $this->slug)->where('status', '=', 'PUBLISHED')->first();
        if ($post !== null) {
            return $post->content();
        } else {
            return null;
        }
    }

    public function post()
    {
        $post = \App\Post::where('slug', '=', $this->slug)->first();
        if ($post !== null) {
            return $post;
        } else {
            return null;
        }
    }
}
