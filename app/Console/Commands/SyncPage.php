<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;


class SyncPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncPage {slug} {url?} {mode?}';

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
        $slug = $this->argument('slug');
        $url = $this->argument('url');
        $mode = $this->argument('mode');

        $temppath = "resources/temp/$slug";

        exec("git clone $url $temppath");

        //Inject Pages if they don't yet exist
        if (Schema::hasTable('pages')) {
            $page = Page::where('slug', '=', $slug)->first();
            if ($page == null) {
                $page = new \App\Page();
                $page->title = ucfirst($slug);
            }
            $themepath = \Config::get('view.paths')[0] . '/theme';
            $pagepath = \Config::get('view.paths')[0] . '/theme/pages/' . $slug;
            $pagejson = \Config::get('view.paths')[0] . '/theme/pages/' . $slug . '/page.json';

            if (file_exists($pagejson)) {
                $page->slug = $slug;
                $page->body = null;
                $page->excerpt = null;
                $page->status = 'INACTIVE';
                $page->author_id = 0;
                $page->save();
            }
            $pages[] = $page;
        }

        $json = file_exists($pagejson);
        if ($json == true && ($mode == 'json' OR $mode == 'all' or $mode == 'reset' or $mode == 'schema')) {
            $json = json_decode(file_get_contents($pagejson));
            if($mode == 'json' or $mode == 'reset') {
                if (isset($json->default)) {
                    $page->json = json_encode($json->default);
                }
            }
            if($mode == 'schema' or $mode == 'reset') {
                $page->schema = json_encode($json);
            }

        }

        $html = file_exists($pagepath . '/body.html');
        if ($html == true && ($mode == 'html' OR $mode == 'all')) {
            $html = file_get_contents($pagepath . '/body.html');
            if ($html !== null) {
                $page->html = $html;
            }
        }

        $css = file_exists($pagepath . '/' . $page->slug . '/css.html');
        if ($css == true && ($mode == 'css' OR $mode == 'all')) {
            $css = file_get_contents($pagepath . '/css.html');
            if ($css !== null) {
                $page->css = $css;
            }
        }

        $scripts = file_exists($pagepath . '/' . $page->slug . '/scripts.html');
        if ($scripts == true && ($mode == 'json' OR $mode == 'all')) {
            $scripts = file_get_contents($pagepath . '/scripts.html');
            if ($scripts !== null) {
                $page->scripts = $scripts;
            }
        }

        $page->save();
        $file = new Filesystem();
        File::deleteDirectory($themepath."/pages/$slug");
        $file->moveDirectory($temppath."/pages/$slug", $themepath."/pages/$slug");
        File::deleteDirectory($temppath);
    }
}
