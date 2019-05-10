<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncPages';

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
        $pages = \App\Page::all();
        foreach ($pages as $page) {
            $page->delete();
        }

        //Inject Pages if they don't yet exist
        $pages = [];

        $themepath = \Config::get('view.paths')[0] . '/theme';
        $pagepath = \Config::get('view.paths')[0] . '/theme/pages';
        foreach (glob($pagepath . "/*") as $filename) {
            $filename = substr($filename, strrpos($filename, '/') + 1);

            if (file_exists($pagepath . '/' . $filename . '/page.json')) {
                $pages[] = $filename;

                $page = \App\Page::where('slug', '=', $filename)->first();
                if ($page == null) {
                    $page = new \App\Page();
                    $page->slug = $filename;
                    $page->title = ucfirst($filename);
                    $page->body = null;
                    $page->excerpt = null;
                    $page->status = 'INACTIVE';
                    $page->save();
                }
            }

            $jsons = [];
            //If page.json exists, push the page to the DB
            $schemaExists = file_exists(
                $pagepath . '/' . $filename . '/page.json'
            );
            if ($schemaExists) {
                echo "\n$filename schema exists. \n";
                $json = file_get_contents(
                    $pagepath . '/' . $filename . '/page.json'
                );
                $json = json_decode($json);
                if (isset($json->slug)) {
                    $page = \App\Page::where('slug', '=', $json->slug)->first();
                } else {
                    $page = null;
                }
                if ($page == null) {
                    $page = new \App\Page();
                    $page->title = "New Page";
                    $page->slug = "new-page";
                }
                $page->schema = json_encode($json);
                $page->save();
            }
        }

        foreach ($pages as $page) {
            $page = \App\Page::where('slug', '=', $page)->first();
            if ($page == null) {
                $page = new \App\Page();
                $page->title = "New Page";
            }
            if ($page->id == null) {
                $json = file_exists(
                    $pagepath . '/' . $page->slug . '/page.json'
                );
                if ($json == true) {
                    $json = json_decode(
                        file_get_contents(
                            $pagepath . '/' . $page->slug . '/page.json'
                        )
                    );
                }
                $html = file_exists(
                    $pagepath . '/' . $page->slug . '/body.html'
                );
                if ($html == true) {
                    $html = file_get_contents(
                        $pagepath . '/' . $page->slug . '/body.html'
                    );
                    if ($html !== null) {
                        $page->html = $html;
                    }
                }
                $css = file_exists($pagepath . '/' . $page->slug . '/css.html');
                if ($css == true) {
                    $css = file_get_contents(
                        $pagepath . '/' . $page->slug . '/css.html'
                    );
                    if ($css !== null) {
                        $page->css = $css;
                    }
                }
                $scripts = file_exists(
                    $pagepath . '/' . $page->slug . '/scripts.html'
                );
                if ($scripts == true) {
                    $scripts = file_get_contents(
                        $pagepath . '/' . $page->slug . '/scripts.html'
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
