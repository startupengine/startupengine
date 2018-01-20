<?php

namespace App\Http\Controllers;

use App\APIResponse;
use App\AnalyticEvent;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getEvents($type) {
        $events = AnalyticEvent::where('event_type', '=', $type)->get();
        return response()->json($events);
    }

    public function getEventsWithKey($type, $key) {
        $events = AnalyticEvent::where('event_type', '=', $type)->whereNotNull("event_data->$key")->get();
        return response()->json($events);
    }

    public function getEventsByKeyAndValue($type, $key, $value) {
        $events = AnalyticEvent::where('event_type', '=', $type)->where("event_data->$key", $value)->get();
        return response()->json($events);
    }

    public function saveEvent(Request $request)
    {
        $event = new AnalyticEvent();
        $event->instance = json_encode($request->instance());
        $event->server = json_encode($request->server);
        $event->segments = json_encode($request->segments());
        $event->decoded_path = $request->decodedPath();
        $event->full_url = $request->fullUrl();
        $event->fingerprint = $request->fingerprint();
        $event->headers = json_encode($request->headers);
        $event->input = json_encode($request->input());
        $event->content = $request->getContent();
        $event->query_string = $request->getQueryString();
        $event->request_uri = $request->getRequestUri();
        $event->scheme = $request->getScheme();
        $event->scheme_and_host = $request->getSchemeAndHttpHost();
        $event->encodings = json_encode($request->getEncodings());
        $event->attributes = json_encode($request->attributes);
        $event->base_path = $request->getBasePath();
        $event->cookies = json_encode($request->getBasePath());
        $event->json = json_encode($request->json());
        if ($request->user() !== null) {
            $event->user_id = $request->input('user_id');
        } else {
            $event->user_id = null;
        }
        if ($request->user() !== null) {
            $event->user_email = $request->input('user_email');
        } else {
            $event->user_email = null;
        }
        if ($request->user() !== null) {
            $event->user_name = $request->input('user_name');
        } else {
            $event->user_name = null;
        }
        $event->user_agent = $request->userAgent();
        $event->client_ip = $request->getClientIp();
        $event->client_ips = json_encode($request->getClientIps());
        $event->client_locale = $request->getLocale();
        $event->languages = json_encode($request->getLanguages());
        $event->script_name = $request->getScriptName();
        $event->event_data = json_encode($request->input('data'));
        if($request->input('event_type') !== null) {
            $event->event_type = $request->input('event_type');
        }
        $event->save();
        if($event !== null) {
            $event->status = 'success';
        }

        return response()
            ->json($event);
    }

    public function getPage(Request $request, $slug)
    {
        $items = new APIResponse();
        return $items->getPage($slug);
    }

    public function getRandomPageVariation(Request $request, $slug)
    {
        $items = new APIResponse();
        return $items->getRandomPageVariation($request, $slug);
    }

    public function getRandomItem(Request $request)
    {
        $items = new APIResponse();
        return $items->getRandomItem($request);
    }

    public function getItem(Request $request)
    {
        $items = new \App\APIResponse();
        return $items->getItem($request);
    }

    public function getItems(Request $request)
    {
        $items = new \App\APIResponse();
        return $items->getItems($request);
    }

    public function search(Request $request)
    {
        $items = new APIResponse();
        return $items->search($request);
    }
}