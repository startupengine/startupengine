<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAnalytics() {
        $response = new APIResponse();
        return $response->getAnalytics();
    }

    public function getTraffic() {
        $response = new APIResponse();
        return $response->getTraffic();
    }
}
