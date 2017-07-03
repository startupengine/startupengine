<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;

class SettingsController extends Controller
{
    /**
     * @var DeliveryClient
     */
    private $client;

    public function __construct(DeliveryClient $client) {
        $this->client = $client;
    }

    public function entryById($id) {
        $entry = $this->client->getEntry($id);
        if (!$entry) {
            abort(404);
        }
        return $entry;
    }

    public function install() {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        $installed = config('app.APP_INSTALLED');
        if ($installed == FALSE) {
            return view('settings.install');
        }
        else {
            return redirect('/');
        }
    }

    public function importComplete() {
        return view('settings.importcomplete');
    }

    public function installContentful(Request $request) {
        $apikey = $request->input('CONTENTFUL_API_KEY');
        $space = $request->input('CONTENTFUL_SPACE_ID');
        $token = $request->input('CONTENTFUL_MANAGEMENT_TOKEN');
        $environment = new \App\Settings;
        $environment->updateEnv(['CONTENTFUL_API_KEY' => $apikey, 'CONTENTFUL_SPACE_ID' => $space, 'APP_INSTALLED' => 'TRUE', 'CONTENTFUL_MANAGEMENT_TOKEN' => $token]);
        return redirect('/install/import');
    }

    public function changeEnvironmentVariable($key,$value) {
        $environment = new \Settings;
        $environment->updateEnv([$key, $value]);
    }
}
