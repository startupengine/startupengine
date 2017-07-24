<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAnalyticsSummary() {
        $response = new APIResponse();
        return $response->getAnalytics();
    }

    public function getTraffic() {
        $response = new APIResponse();
        return $response->getTraffic();
    }

    public function getTrafficByPage($page) {
        $response = new APIResponse();
        return $response->getTraffic($page);
    }

    public function getTrafficByCategory($category) {
        $response = new APIResponse();
        return $response->getTraffic($category);
    }

    public function getEvents() {
        $response = new APIResponse();
        return $response->getEvents();
    }

    public function getEventsByType($type) {
        $response = new APIResponse();
        return $response->getEvents($type);
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