<?php

namespace App\Console\Commands;

use App\Page;
use App\Package;
use App\PostType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;


class SyncPostType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncPostType {slug} {url?} {mode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull the latest version of a post type from a git repo.';

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
        $tempdir = "resources/temp";
        $themepath = "resources/views/theme";
        File::deleteDirectory($tempdir);
        File::deleteDirectory($themepath . "/.git");
        exec("git clone $url $tempdir");
        $schema = file_get_contents("/resources/temp/resources/views/theme/templates/$slug/schema.json");
        if (Schema::hasTable('pages')) {
            $postType = PostType::where('slug', '=', $slug)->first();
            if ($postType == null) {
                $postType = new PostType();
            }
            $postType->json = json_encode(json_decode($schema));
            $postType->save();
        }
        File::deleteDirectory($tempdir);
    }
}
