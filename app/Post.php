<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function bodyHtml()
    {
        return Markdown::convertToHtml($this->body);
    }

    public function category() {
        $category = \App\Category::where('id', '=', $this->category_id)->first();
        return $category;
    }
}
