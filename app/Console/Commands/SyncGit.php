<?php

namespace App\Console\Commands;

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
    protected $signature = 'command:SyncGit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $path = \Config::get('view.paths')[0] . '/theme';
        exec('rm -rf ' . escapeshellarg($path));
        if (config('app.template_git_username') !== null && config('app.template_git_password') !== null) {
            exec("git clone https://" . config('app.template_git_username') . ":" . config('app.template_git_password') . "@github.com/" . config('app.template_git_username') . "/" . config('app.template_git_repository') . ".git resources/views/theme");
        } else {
            exec("git clone https://github.com/" . config('app.template_git_username') . "/" . config('app.template_git_repository') . ".git resources/views/theme");
        }
        $themepath = \Config::get('view.paths')[0] . '/theme';
        $pagepath = \Config::get('view.paths')[0] . '/theme/pages';

        if (Schema::hasTable('settings')) {
            $json = json_decode(file_get_contents($themepath . '/theme.json'));

            foreach ($json->settings as $setting) {
                $existingsetting = Setting::where('key', '=', $setting->key)->first();
                if ($existingsetting == null) {
                    $newsetting = new Setting();
                } else {
                    $newsetting = $existingsetting;
                }
                $newsetting->key = $setting->key;
                $newsetting->display_name = $setting->display_name;
                $newsetting->status = $setting->status;
                $newsetting->type = $setting->type;
                $newsetting->save();
            }
        }

        if (Schema::hasTable('post_types')) {
            $json = json_decode(file_get_contents($themepath . '/theme.json'));
            $schemas = $json->schemas;
            foreach ($schemas as $schema) {
                $schemapath = $themepath . '/templates/' . $schema . '/schema.json';
                $contents = json_decode(file_get_contents($schemapath));
                $entry = PostType::where('slug', '=', $schema)->first();
                if($entry == null) {
                    $entry = new \App\PostType();
                }
                $entry->json = json_encode($contents);
                $entry->slug = $schema;
                $entry->title = $contents->title;
                $entry->enabled = true;
                $entry->save();
            }
        }

        $pages = [];
        if (Schema::hasTable('pages')) {
            if (count(\App\Page::all()) > 1) {
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