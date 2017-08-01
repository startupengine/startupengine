<?php

namespace App\Http\Controllers;
use App\ContentItem;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PageController extends Controller
{

    /**
     * @var DeliveryClient
     */
    private $client;

    public function __construct(DeliveryClient $client) {
        $this->client = $client;
    }

    public function entryById($id) {
        $entry = $this->client->getEntry($id);
        if (!$entry) {
            abort(404);
        }
        return $entry;
    }

    public function getArticle($slug) {
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType('settings')
            ->where('fields.slug', 'Default');
        $defaults = $this->client->getEntries($query);
        if (!empty($defaults->getItems())) {
            $defaults = $defaults->getItems()[0];
        } else {
            $defaults = NULL;
        }
        $query2 = (new \Contentful\Delivery\Query())
            ->setInclude(2)
            ->setContentType('page')
            ->where('fields.slug', $slug);
        $pages = $this->client->getEntries($query2);
        if (empty($pages->getItems())) {
            abort(404);
        }
        $page = $pages[0];
        $campaign = $page->getCampaign();
        $pageJson = json_decode(json_encode($page));
        $site = env('STARTUPENGINE_SITE_ID');
        $space = $pageJson->sys->space->sys->id;
        $uid = $pageJson->sys->id;
        $version = $pageJson->sys->revision;

        $contentItem = ContentItem::where('space', '=', $space)->where('uid', '=', $uid)->where('version', '=', $version)->first();
        if($contentItem == null) {
            $contentItem = new ContentItem();
            $contentItem->uid = $uid;
            $contentItem->version = $version;
            $contentItem->space = $space;
            $string = "";
            foreach ($page->getSections() as $section) {
                $string = $string . ' ' . $section->getContent() . ' ' . $section->getButtonText();
            }
            $string = $page->getTitle() . ' ' . $page->getDescription() . ' ' . $string;
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
            if ($result !== null && $result->watson_analysis !== NULL) {
                $analysis = json_decode($result->watson_analysis);
                $contentItem->watson_analysis = $result->watson_analysis;
                $contentItem->save();
            }
        }
        //dd($contentItem->getDominantEmotion());
        return view('welcome')->with('page', $page)->with('defaults', $defaults)->with('analyticsCategory', 'article')->with('campaign', $campaign)->with('contentItem', $contentItem);//->with('analysis', $analysis)->with('dominantEmotion', $dominantEmotion);
    }

    public function getArticles($slug = NULL) {
        if($slug == NULL) {
            $slug = 'page';
        }
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType($slug)
            ->setInclude(2);
        $articles = $this->client->getEntries($query);
        $query2 = (new \Contentful\Delivery\Query());
        $query2->setContentType('settings')
            ->where('fields.slug', 'Default');
        $defaults = $this->client->getEntries($query2);
        if(!empty($defaults->getItems())) { $defaults = $defaults->getItems()[0]; } else { $defaults = NULL; }
        return view('pages.index')->with('articles', $articles)->with('defaults', $defaults)->with('analyticsCategory', 'articles');
    }

    public function getHomepage() {

        $query = (new \Contentful\Delivery\Query());
        $query->setContentType('settings')
            ->where('fields.slug', 'Default');
        $defaults = $this->client->getEntries($query);
        if (empty($defaults->getItems())) {
            abort(404);
        }
        $homepage = $defaults[0]->getHomepage();
        if (!empty($defaults->getItems())) {
            $defaults = $defaults->getItems()[0];
        } else {
            $defaults = NULL;
        }
        return view('welcome')->with('page', $homepage)->with('defaults', $defaults)->with('analyticsCategory', 'homepage');

    }
}