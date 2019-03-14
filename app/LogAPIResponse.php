<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\RequestLog as RequestLogResource;

class LogAPIResponse
{
    public function getRequests(Request $request)
    {
        $paginatedResults = \App\RequestLog::orderBy('created_at', 'desc')->simplePaginate(20);

        $response = json_decode(json_encode($paginatedResults));
        $response->total = count($paginatedResults);
        $response->pages = ceil($response->total / 10);
        if ($response->pages == 0) {
            $response->pages = 1;
        }

        //return new RequestLogResource($response);
        return $response;
    }
}
