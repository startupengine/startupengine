<?php

$ch = curl_init(env('GOOGLE_ANALYTICS_CREDENTIALS', storage_path('app/google/analytics-credentials.json')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
$string = curl_exec($ch);
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
curl_close($ch);

if ($curl_errno > 0) {
    dd( "cURL Error ($curl_errno): $curl_error\n");
} else {
    $json = $data;
}

return [

    /*
     * The view id of which you want to display data.
     */
    'view_id' => env('GOOGLE_ANALYTICS_VIEW_ID'),

    /*
     * Path to the client secret json file. Take a look at the README of this package
     * to learn how to get this file.
     */
    'service_account_credentials_json' => $data,

    /*
     * The amount of minutes the Google API responses will be cached.
     * If you set this to zero, the responses won't be cached at all.
     */
    'cache_lifetime_in_minutes' => 60 * 24,

    /*
     * Here you may configure the "store" that the underlying Google_Client will
     * use to store it's data.  You may also add extra parameters that will
     * be passed on setCacheConfig (see docs for google-api-php-client).
     *
     * Optional parameters: "lifetime", "prefix"
     */
    'cache' => [
        'store' => 'file',
    ],
];