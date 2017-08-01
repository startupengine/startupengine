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

    public function getAnalysisJson() {
        if ($this->watson_analysis !== null) {
            $analysis = json_decode(json_encode($this->watson_analysis), true);
            $analysis = json_decode($analysis);
            return $analysis;
        }
    }

    public function getSentiment() {
        if ($this->watson_analysis !== null) {
            $analysis = json_decode(json_encode($this->watson_analysis), true);
            $analysis = json_decode($analysis);
            if(isset($analysis->sentiment->document)) { return $analysis->sentiment->document; }
            else { return null; }
        }
    }

    public function getKeywords() {
        if ($this->watson_analysis !== null) {
            $analysis = json_decode(json_encode($this->watson_analysis), true);
            $analysis = json_decode($analysis);
            return $analysis->keywords;
        }
    }

    public function getConcepts() {
        if ($this->watson_analysis !== null) {
            $concepts = json_decode(json_encode($this->watson_analysis), true);
            $concepts = json_decode($concepts);
            $concepts = $concepts->concepts;
            if(!empty($concepts)) {
                $concepts = json_encode($concepts);
                $concepts = json_decode($concepts, true);
            }
            else { return null; }
        }
    }


    public function getEmotions() {
        if ($this->watson_analysis !== null) {
            $emotions = json_decode(json_encode($this->watson_analysis), true);
            $emotions = json_decode($emotions);
            $emotions = $emotions->emotion->document->emotion;
            $emotions = json_encode($emotions);
            $emotions = json_decode($emotions, true);
            $processedEmotions = [];
            foreach ($emotions as $key => $value) {
                $processedEmotions[$key] = (float) $value * 100;
            }
            return $processedEmotions;
        }
        else { return null; }
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

    public function getContentItemAnalysis ($page, $space, $uid, $version) {
        $contentItem = ContentItem::where('space', '=', $space)->where('uid', '=', $uid)->where('version', '=', $version)->first();
        if($contentItem == null) {
            $site = env('STARTUPENGINE_SITE_ID');
            $contentItem = new ContentItem();
            $contentItem->uid = $uid;
            $contentItem->version = $version;
            $contentItem->space = $space;
            $string = "";
            foreach ($page->getSections() as $section) {
                $string = $string . ' ' . $section->getContent() . ' ' . $section->getButtonText();
            }
            $string = $page->getTitle() . ' - ' . $page->getDescription() . ' ' . $string;
            $url = "http://127.0.0.1:8000/api/v1/$site/nlp/contentful/$space/$uid/version/$version";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => "8000",
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"text\"\r\n\r\n$string\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                $result = json_encode(['result' => ['error' => $err]]);
            } else {
                $result = json_decode($response);
            }
            if ($result !== null && isset($result->watson_analysis)) {
                $analysis = json_decode($result->watson_analysis);
                $contentItem->watson_analysis = $result->watson_analysis;
                $contentItem->save();
            }
        }
        return $contentItem;
    }

}