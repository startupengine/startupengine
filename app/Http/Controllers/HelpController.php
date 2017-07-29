<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;

class HelpController extends Controller
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

    public function index() {
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType('settings')
            ->where('fields.slug', 'Default');
        $defaults = $this->client->getEntries($query);
        if (!empty($defaults->getItems())) {
            $defaults = $defaults->getItems()[0];
        } else {
            $defaults = NULL;
        }
        return view('help.index')->with('defaults', $defaults)->with('analyticsCategory', 'help');
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
        $query2 = (new \Contentful\Delivery\Query());
        $query2->setContentType('help')
            ->where('fields.slug', $slug);
        $pages = $this->client->getEntries($query2);
        if (empty($pages->getItems())) {
            abort(404);
        }
        $page = $pages[0];
        return view('help.view')->with('help', $page)->with('defaults', $defaults)->with('analyticsCategory', 'help');
    }

}
