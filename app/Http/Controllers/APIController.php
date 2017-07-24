<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('apisecret');
    }

    public function getOverview() {
        $response = new APIResponse();
        return $response->getOverview();
    }

    public function getTrafficSummary() {
        $response = new APIResponse();
        return $response->getTraffic();
    }

    public function getTrafficByPage($page) {
        $response = new APIResponse();
        return $response->getTraffic($page);
    }

    public function getTrafficByType($type) {
        $response = new APIResponse();
        return $response->getTraffic($type);
    }

    public function getEventsSummary() {
        $response = new APIResponse();
        return $response->getEvents();
    }

    public function getEventsByType($type) {
        $response = new APIResponse();
        return $response->getEvents($type);
    }

    public function getContentSummary() {
        $response = new APIResponse();
        return $response->getContent();
    }

    public function getContentByType($type) {
        $response = new APIResponse();
        return $response->getContent($type);
    }

    public function getUsersSummary() {
        $response = new APIResponse();
        return $response->getUsers();
    }

    public function getExperimentsSummary() {
        $response = new APIResponse();
        return $response->getExperiments();
    }

    public function getExperimentsByName($name) {
        $response = new APIResponse();
        return $response->getExperiments($name);
    }
}