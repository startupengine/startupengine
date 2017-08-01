<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Contentful\Delivery\Client as DeliveryClient;
//use Laravel\Scout\Searchable;

class ContentItem extends Model
{
    protected $table = 'content_items';

    protected $fillable = ['title', 'content', 'description', 'space',  'uid', 'version', 'watson_analysis'];

    //use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'articles_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

    public function getDominantEmotion() {
        if ($this->watson_analysis !== null) {
            $emotions = json_decode(json_encode($this->watson_analysis), true);
            $emotions = json_decode($emotions);
            $emotions = $emotions->emotion->document->emotion;
            $emotions = json_encode($emotions);
            $emotions = json_decode($emotions, true);
            foreach ($emotions as $key => $value) {
                $emotions[$key] = (float)$value * 100;
            }
            $dominantEmotion = array_keys($emotions, max($emotions));
            return $dominantEmotion[0];
        }
        else { return null; }
    }

}