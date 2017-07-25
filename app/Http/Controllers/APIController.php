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