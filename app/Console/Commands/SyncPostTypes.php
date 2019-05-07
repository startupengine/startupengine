<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPostTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncPostTypes';

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
        $files = scandir(storage_path() . '/schemas/post_types');
        foreach ($files as $file) {
            if (strpos($file, '.json')) {
                $json = json_decode(
                    file_get_contents(
                        storage_path() . '/schemas/post_types/' . $file
                    )
                );

                $slug = str_replace(".json", "", $file);

                $postType = \App\PostType::firstOrCreate([
                    'slug' => $slug
                ]);
                $postType->save();
            }
        }
    }
}
