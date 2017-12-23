<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class SyncSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncSchema {slug} {url?} {mode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Post Type schemas & templates individually';

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

        //Inject Post Type Schema
        if (Schema::hasTable('post_types')) {

            $themepath = \Config::get('view.paths')[0] . '/theme';
            $json = json_decode(file_get_contents($themepath . '/theme.json'));
            $schemas = $json->schemas;

            foreach ($schemas as $schema) {
                $schemapath = $themepath . '/templates/' . $schema . '/schema.json';
                if (file_exists($themepath . '/templates/' . $schema . '/schema.json')) {
                    $contents = json_decode(file_get_contents($schemapath));
                    $entry = PostType::where('slug', '=', $schema)->first();
                    if ($entry == null) {
                        $entry = new \App\PostType();
                    }
                    if ($entry == null OR $mode == 'reset') {
                        $entry->json = json_encode($contents);
                        $entry->slug = $schema;
                        $entry->title = $contents->title;
                        $entry->enabled = true;
                        $entry->save();
                    }
                }
            }
        }

        $file = new Filesystem();
        File::deleteDirectory($themepath . "/templates/$slug");
        $file->moveDirectory($temppath . "/templates/$slug", $themepath . "/templates/$slug");
        File::deleteDirectory($temppath);
    }
}
