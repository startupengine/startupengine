<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticEvent extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', "segments", "decoded_path", 'cookies', "encodings", "base_path", "user_id", "client_ips", "languages", "script_name", "fingerprint", "headers", "input", "content", "attributes", "user_email", "user_name", "server", "instance", "json", "scheme_and_host", "query_string", "full_url"
    ];
}
