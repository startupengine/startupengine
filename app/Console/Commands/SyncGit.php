<?php

namespace App\Console\Commands;

use App\Package;
use App\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\PostType;

class SyncGit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncGit {mode=add}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone remote git repositories and sync their contents to the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->argument('mode');

        $path = \Config::get('view.paths')[0] . '/theme';
        exec('rm -rf ' . escapeshellarg($path));

        $packages = Package::all();
        if ($packages->isEmpty()) {
            $defaultpackage = new Package();
            $defaultpackage->url = "https://github.com/luckyrabbitllc/Startup-Engine-Template.git";
            $defaultpackage->save();
            $packages = Package::all();
        }

        $themepath = \Config::get('view.paths')[0] . '/theme';
        $pagepath = \Config::get('view.paths')[0] . '/theme/pages';
        foreach ($packages as $package) {
            exec("git clone $package->url resources/views/theme");
            if (Schema::hasTable('packages')) {
                $package->json = file_get_contents($themepath . '/theme.json');
                $package->save();
            }
        }

        //Inject settings if they don't yet exist
        if (Schema::hasTable('settings')) {
            $json = json_decode(file_get_contents($themepath . '/theme.json'));

            foreach ($json->settings as $setting) {
                $existingsetting = Setting::where('key', '=', $setting->key)->first();
                if ($existingsetting == null) {
                    $newsetting = new Setting();
                    if(property_exists($setting, 'value')) {
                        $newsetting->value = $setting->value;
                    }
                    $newsetting->key = $setting->key;
                    $newsetting->display_name = $setting->display_name;
                    $newsetting->status = $setting->status;
                    $newsetting->type = $setting->type;
                    $newsetting->group = $setting->group;
                    $newsetting->save();
                }

                if ($existingsetting !== null && $mode == "reset") {
                    if(property_exists($setting, 'value')) {
                        $existingsetting->value = $setting->value;
                    }
                    $existingsetting->key = $setting->key;
                    $existingsetting->display_name = $setting->display_name;
                    $existingsetting->status = $setting->status;
                    $existingsetting->type = $setting->type;
                    $existingsetting->group = $setting->group;
                    $existingsetting->save();
                }

            }
        }

        //Inject Post Types if they don't yet exist
        if (Schema::hasTable('post_types')) {
            $json = json_decode(file_get_contents($themepath . '/theme.json'));
            $schemas = $json->schemas;
            foreach ($schemas as $schema) {
                $schemapath = $themepath . '/templates/' . $schema . '/schema.json';
                if (file_exists($themepath . '/templates/' . $schema . '/schema.json')) {
                    $contents = json_decode(file_get_contents($schemapath));
                    $entry = PostType::where('slug', '=', $schema)->first();
                    if ($entry == null) {
                        $entry = new \App\PostType();
                        $entry->json = json_encode($contents);
                        $entry->slug = $schema;
                        $entry->title = $contents->title;
                        $entry->enabled = true;
                        $entry->save();
                    }
                }
            }
        }

        //Inject Pages if they don't yet exist
        $pages = [];
        if (Schema::hasTable('pages')) {
            if (count(\App\Page::all()) > 1 OR $mode == 'reset') {
                foreach (glob($pagepath . "/*") as $filename) {
                    $filename = substr($filename, strrpos($filename, '/') + 1);
                    $pages[] = $filename;
                    $page = \App\Page::where('slug', '=', $filename)->first();
                    if ($page == null) {
                        $page = new \App\Page();
                        $page->slug = $filename;
                        $page->title = ucfirst($filename);
                        $page->body = null;
                        $page->excerpt = null;
                        $page->status = 'INACTIVE';
                        $page->author_id = 0;
                        $page->save();
                    }
                    //If page.json exists, push it to the DB
                    /*
                    if(file_exists($pagepath.'/'.$filename.'/page.json')) {
                        $json = json_decode(file_get_contents($pagepath.'/'.$filename.'/page.json'));
                        if($json->title == "Home") {
                            dd($json);
                        }
                    };
                    */
                }
            }
        }

    }
}