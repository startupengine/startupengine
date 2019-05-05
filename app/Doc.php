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
use GrahamCampbell\Markdown\Facades\Markdown;

class Doc extends Model
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

    public function content()
    {
        return $this->content;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/doc.json');
        $baseSchema = json_decode($path);
        return $baseSchema;
    }

    public function highlightedSearchResults()
    {
        if (request()->input('s') != null) {
            $search = request()->input('s');
            $markdown = Markdown::convertToHtml($this->content);
            $markdown = strip_tags($markdown, '<br><p></p>');
            $search = str_replace("%20", " ", $search);
            $words = explode(" ", $search);
            $positions = [];
            foreach ($words as $word) {
                $position = stripos($markdown, $word);
                //dd($markdown);
                if ($position != false) {
                    $positions[] = $position;
                }
            }
            sort($positions);

            if (count($positions) == 0) {
                $position = 0;
            } else {
                $position = $positions[0];
            }
            $markdown =
                substr(highlightWords($markdown, $search), $position, 300) .
                "<span class='dimmed ml-1'>...</span>";

            return $markdown;
        }
    }

    public function markdown($content)
    {
        return Markdown::convertToHtml($content);
    }

    public function searchFields()
    {
        return ['content'];
    }

    public function title()
    {
        $markdown = strtok($this->content, "\n");
        $markdown = str_replace("#", "", $markdown);
        $markdown = strip_tags(Markdown::convertToHtml($markdown));
        return $markdown;
    }
}
