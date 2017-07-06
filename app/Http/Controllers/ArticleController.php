<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;

class ArticleController extends Controller
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
        $query->setContentType('article')
            ->where('fields.slug', $slug)
            ->setInclude(2);
        $entries = $this->client->getEntries($query);
        if (empty($entries->getItems())) {
            abort(404);
        }
        $article = $entries[0];
        $query2 = (new \Contentful\Delivery\Query());
        $query2->setContentType('defaults')
            ->where('fields.slug', 'default');
        $defaults = $this->client->getEntries($query2);
        if(!empty($defaults->getItems())) { $defaults = $defaults->getItems()[0]; } else { $defaults = NULL; }
        $splash = $article->getSplashClass();
        return view('articles.view')->with('article', $article)->with('defaults', $defaults)->with('splash', $splash);
    }

    public function getArticles($slug = NULL) {
        if($slug == NULL) {
            $slug = 'article';
        }
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType($slug)
            ->setInclude(2);
        $articles = $this->client->getEntries($query);

        $query2 = (new \Contentful\Delivery\Query());
        $query2->setContentType('defaults')
            ->where('fields.slug', 'default');
        $defaults = $this->client->getEntries($query2);
        if(!empty($defaults->getItems())) { $defaults = $defaults->getItems()[0]; } else { $defaults = NULL; }
        return view('articles.index')->with('articles', $articles)->with('defaults', $defaults);
    }

    public function getHomepage() {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        $installed = config('app.APP_INSTALLED');
        if ($installed == FALSE) {
            return view('settings.welcome');
        }
        else {
            $query = (new \Contentful\Delivery\Query());
            $query->setContentType('defaults')
                ->where('fields.slug', 'default');
            $defaults = $this->client->getEntries($query);
            if (empty($defaults->getItems())) {
                abort(404);
            }
            $article = $defaults[0]->getHomepage();
            if (!empty($defaults->getItems())) {
                $defaults = $defaults->getItems()[0];
            } else {
                $defaults = NULL;
            }
            $splash = $article->getSplashClass();
            return view('welcome')->with('article', $article)->with('defaults', $defaults)->with('splash', $splash);
        }
    }
}