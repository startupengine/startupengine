<?php

namespace App\Console\Commands;

use App\Package;
use App\Page;
use App\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\PostType;
use Illuminate\Support\Facades\File;

class SyncGit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncGit {mode?}';

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
        $tempdir = "resources/temp";
        $themepath = \Config::get('view.paths')[0] . '/theme';
        exec('rm -rf ' . escapeshellarg($path));

        //Install Packages
        if (Schema::hasTable('packages')) {
            $packages = Package::all();
            if ($packages->isEmpty()) {
                $defaultpackage = new Package();
                $defaultpackage->url =
                    "https://github.com/startupengine/Startup-Engine-Template.git";
                $defaultpackage->save();
                $packages = Package::all();
            }
            foreach ($packages as $package) {
                File::deleteDirectory($tempdir);
                File::deleteDirectory($themepath . "/.git");
                exec("git clone $package->url $tempdir");
                File::copyDirectory(
                    $tempdir . "/resources/views/theme",
                    $themepath
                );

                if (file_exists($tempdir . "/storage/docs")) {
                    File::copyDirectory(
                        $tempdir . "/storage/docs",
                        storage_path('/docs')
                    );
                }

                if (file_exists($tempdir . "/resources/views") &&
                    ($mode == "default" or $mode == "reset")
                ) {
                    $files = File::allFiles($tempdir . "/resources/views");
                    foreach ($files as $file) {
                        File::copy(
                            (string) $file,
                            str_replace(
                                'resources/temp/resources/',
                                'resources/',
                                (string) $file
                            )
                        );
                        echo (string) $file, "\n";
                    }
                }

                if (file_exists($tempdir . "/resources/views/theme/pages") &&
                    $mode == "pages"
                ) {
                    $files = File::allFiles(
                        $tempdir . "/resources/views/theme/pages"
                    );
                    foreach ($files as $file) {
                        File::copy(
                            (string) $file,
                            str_replace(
                                'resources/temp/resources/',
                                'resources/',
                                (string) $file
                            )
                        );
                        echo (string) $file, "\n";
                    }
                }

                if (file_exists($tempdir . "/app/modules") &&
                    ($mode == "modules" or $mode == "reset")
                ) {
                    $files = File::directories($tempdir . "/app/modules");
                    foreach ($files as $file) {
                        $oldPath = $file;
                        $newPath = str_replace(
                            'resources/temp/',
                            '',
                            (string) $file
                        );
                        File::copyDirectory($oldPath, $newPath);
                        echo "$oldPath copied to\n$newPath \n\n";
                    }
                }

                File::deleteDirectory($themepath . "/.git");
                $package->json = file_get_contents($tempdir . '/startup.json');
                $contents = json_decode(
                    file_get_contents($tempdir . '/startup.json')
                );
                $package->description = $contents->description;

                $package->save();

                //Inject settings into the database if they don't yet exist
                if (Schema::hasTable('settings')) {
                    $themepath = \Config::get('view.paths')[0] . '/theme';
                    $json = json_decode(
                        file_get_contents($tempdir . '/startup.json')
                    );

                    if ($json->settings !== null) {
                        foreach ($json->settings as $setting) {
                            $existingsetting = Setting::where(
                                'key',
                                '=',
                                $setting->key
                            )->first();
                            if ($existingsetting == null) {
                                $newsetting = new Setting();
                                if (property_exists($setting, 'value')) {
                                    $newsetting->value = $setting->value;
                                }
                                $newsetting->key = $setting->key;
                                $newsetting->display_name =
                                    $setting->display_name;
                                $newsetting->status = $setting->status;
                                $newsetting->type = $setting->type;
                                $newsetting->group = $setting->group;
                                $newsetting->save();
                            }

                            if ($existingsetting !== null && $mode == "reset") {
                                if (property_exists($setting, 'value')) {
                                    $existingsetting->value = $setting->value;
                                }
                                $existingsetting->key = $setting->key;
                                $existingsetting->display_name =
                                    $setting->display_name;
                                $existingsetting->status = $setting->status;
                                $existingsetting->type = $setting->type;
                                $existingsetting->group = $setting->group;
                                $existingsetting->save();
                            }

                            //Inject Post Types if they don't yet exist
                            if (Schema::hasTable('post_types')) {
                                $themepath =
                                    \Config::get('view.paths')[0] . '/theme';
                                $json = json_decode(
                                    file_get_contents(
                                        $tempdir . '/startup.json'
                                    )
                                );
                                if (isset($json->content_types->active)) {
                                    $schemas = $json->content_types->active;
                                    foreach ($schemas
 as $schema => $schemaValue) {
                                        $schemapath =
                                            $themepath .
                                            '/templates/' .
                                            $schema .
                                            '/schema.json';
                                        if (file_exists(
                                            $themepath .
                                                    '/templates/' .
                                                    $schema .
                                                    '/schema.json'
                                        )
                                        ) {
                                            $entry = PostType::where(
                                                'slug',
                                                '=',
                                                $schema
                                            )->first();
                                            if ($entry == null or
                                                $mode == 'default'
                                            ) {
                                                $entry = new \App\PostType();
                                            }
                                            if ($entry == null or
                                                $mode == 'reset' or
                                                $mode == 'schema'
                                            ) {
                                                $contents = json_decode(
                                                    file_get_contents(
                                                        $schemapath
                                                    )
                                                );
                                                $title = $contents->title;
                                                $entry->title = $title;
                                                $entry->slug = $schema;
                                                $entry->json = json_encode(
                                                    $contents
                                                );
                                                $entry->enabled = true;
                                                $entry->save();
                                            }
                                        }
                                    }
                                }
                            }

                            //Inject Pages if they don't yet exist
                            $pages = [];
                            if (Schema::hasTable('pages')) {
                                if (count(\App\Page::all()) < 1 or
                                    $mode == 'reset' or
                                    $mode == 'pages'
                                ) {
                                    $themepath =
                                        \Config::get('view.paths')[0] .
                                        '/theme';
                                    $pagepath =
                                        \Config::get('view.paths')[0] .
                                        '/theme/pages';
                                    foreach (glob($pagepath . "/*")
 as $filename) {
                                        $filename = substr(
                                            $filename,
                                            strrpos($filename, '/') + 1
                                        );
                                        if (file_exists(
                                            $pagepath .
                                                    '/' .
                                                    $filename .
                                                    '/page.json'
                                        )
                                        ) {
                                            $pages[] = $filename;
                                            $page = \App\Page::where(
                                                'slug',
                                                '=',
                                                $filename
                                            )->first();
                                            if ($page == null) {
                                                $page = new \App\Page();
                                                $page->slug = $filename;
                                                $page->title = ucfirst(
                                                    $filename
                                                );
                                                $page->body = null;
                                                $page->excerpt = null;
                                                $page->status = 'INACTIVE';
                                                $page->save();
                                            }
                                        }

                                        $jsons = [];
                                        //If page.json exists, push the page to the DB
                                        $schemaExists = file_exists(
                                            $pagepath .
                                                '/' .
                                                $filename .
                                                '/page.json'
                                        );
                                        if ($schemaExists) {
                                            echo "\n$filename schema exists. \n";
                                            $json = file_get_contents(
                                                $pagepath .
                                                    '/' .
                                                    $filename .
                                                    '/page.json'
                                            );
                                            $json = json_decode($json);
                                            $page = Page::where(
                                                'slug',
                                                '=',
                                                $json->slug
                                            )->first();
                                            if ($page == null) {
                                                $page = new Page();
                                            }
                                            $page->schema = json_encode($json);
                                            $page->save();
                                        }
                                    }

                                    foreach ($pages as $page) {
                                        $page = Page::where(
                                            'slug',
                                            '=',
                                            $page
                                        )->first();
                                        if ($page == null) {
                                            $page = new Page();
                                        }
                                        if ($page->id == null or
                                            $mode == 'reset'
                                        ) {
                                            $json = file_exists(
                                                $pagepath .
                                                    '/' .
                                                    $page->slug .
                                                    '/page.json'
                                            );
                                            if ($json == true) {
                                                $json = json_decode(
                                                    file_get_contents(
                                                        $pagepath .
                                                            '/' .
                                                            $page->slug .
                                                            '/page.json'
                                                    )
                                                );
                                                if ($mode == "reset") {
                                                    if (isset($json->default)) {
                                                        $json = json_encode(
                                                            $json->default
                                                        );
                                                    } else {
                                                        $json = null;
                                                    }
                                                    $page->json = $json;
                                                }
                                            }
                                            $html = file_exists(
                                                $pagepath .
                                                    '/' .
                                                    $page->slug .
                                                    '/body.html'
                                            );
                                            if ($html == true) {
                                                $html = file_get_contents(
                                                    $pagepath .
                                                        '/' .
                                                        $page->slug .
                                                        '/body.html'
                                                );
                                                if ($html !== null) {
                                                    $page->html = $html;
                                                }
                                            }
                                            $css = file_exists(
                                                $pagepath .
                                                    '/' .
                                                    $page->slug .
                                                    '/css.html'
                                            );
                                            if ($css == true) {
                                                $css = file_get_contents(
                                                    $pagepath .
                                                        '/' .
                                                        $page->slug .
                                                        '/css.html'
                                                );
                                                if ($css !== null) {
                                                    $page->css = $css;
                                                }
                                            }
                                            $scripts = file_exists(
                                                $pagepath .
                                                    '/' .
                                                    $page->slug .
                                                    '/scripts.html'
                                            );
                                            if ($scripts == true) {
                                                $scripts = file_get_contents(
                                                    $pagepath .
                                                        '/' .
                                                        $page->slug .
                                                        '/scripts.html'
                                                );
                                                if ($scripts !== null) {
                                                    $page->scripts = $scripts;
                                                }
                                            }
                                            $page->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                File::deleteDirectory($tempdir);
            }
        }
    }
}
