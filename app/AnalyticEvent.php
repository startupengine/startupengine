<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AnalyticEvent extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', "segments", "decoded_path", 'cookies', "encodings", "base_path", "user_id", "client_ips", "languages", "script_name", "fingerprint", "headers", "input", "content", "attributes", "user_email", "user_name", "server", "instance", "json", "scheme_and_host", "query_string", "full_url", "deleted_at", "user_agent", "updated_at", "scheme", "request_uri", "session", "session_id", "client_ip", "client_locale", "event_data"
    ];

    public function createFromRequest(Request $request){
        $this->instance = json_encode($request->instance());
        $this->server = json_encode($request->server);
        $this->segments = json_encode($request->segments());
        $this->decoded_path = $request->decodedPath();
        $this->full_url = $request->fullUrl();
        $this->fingerprint = $request->fingerprint();
        $this->headers = json_encode($request->headers);
        $this->input = json_encode($request->input());
        $this->content = $request->getContent();
        $this->query_string = $request->getQueryString();
        $this->request_uri = $request->getRequestUri();
        $this->scheme = $request->getScheme();
        $this->scheme_and_host = $request->getSchemeAndHttpHost();
        $this->encodings = json_encode($request->getEncodings());
        $this->attributes = json_encode($request->attributes);
        //$this->base_path = $request->getBasePath();
        //$this->cookies = json_encode($request->getBasePath());
        //$this->json = json_encode($request->json());
        /*if ($request->input('user_id') !== null) {
            $this->user_id = $request->input('user_id');
        } else {
            $this->user_id = null;
        }
        if ($request->input('user_email') !== null) {
            $this->user_email = $request->input('user_email');
        } else {
            $this->user_email = null;
        }
        if ($request->input('user_name') !== null) {
            $this->user_name = $request->input('user_name');
        } else {
            $this->user_name = null;
        }
        $this->user_agent = $request->userAgent();
        $this->client_ip = $request->getClientIp();
        $this->client_ips = json_encode($request->getClientIps());
        $this->client_locale = $request->getLocale();
        $this->languages = json_encode($request->getLanguages());
        $this->script_name = $request->getScriptName();
        $this->event_data = json_encode($request->input('data'));
        if($request->input('event_type') !== null) {
            $this->event_type = $request->input('event_type');
        }
        */
        $this->save();
    }

}
