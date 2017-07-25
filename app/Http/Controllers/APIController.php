<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;

class APIController extends Controller
{

    /**
     * @var DeliveryClient
     */
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DeliveryClient $client)
    {
        $this->middleware('apisecret');
        $this->client = $client;
    }

    // Google Analytics
    public function performQuery(Request $request) {
        $response = new APIResponse();
        return $response->performQuery($request);
    }

    // Traffic
    public function getTraffic(Request $request) {
        $response = new APIResponse();
        return $response->getTraffic($request);
    }

    public function getTrafficForCampaign(Request $request, $campaign) {
        $response = new APIResponse();
        $pages = $response->getContent($client = $this->client, 'page', $campaign);
        $pages = $pages->original["raw"];
        $results = [];
        $filters = "";
        foreach($pages as $page){
            $path = "/".$page->getSlug();
            if(strtolower($page->getType()) !== "landing" && strtolower($page->getType()) !== "page") { $path = "/".strtolower($page->getType()).$path; }
            $results[] = "ga:pagePath=@".$path;
        }
        $filters = implode($results, ',');
        return $response->performQuery($request, 'ga:totalEvents,ga:sessions', ['sort'=>'ga:date', 'dimensions' => 'ga:date', 'filters' => $filters]);
    }

    // Events
    public function getEvents(Request $request) {
        $response = new APIResponse();
        return $response->getEvents($request);
    }

    public function getEventsByType(Request $request, $type) {
        $response = new APIResponse();
        return $response->getEvents($request, $type);
    }

    // Content
    public function getContentByType($type) {
        $response = new APIResponse();
        return $response->getContent($client = $this->client, $type);
    }

    public function getContentByCampaign($campaign) {
        $response = new APIResponse();
        return $response->getContent($client = $this->client, null, $campaign);
    }

}