<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SyncDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncDocs';

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
        $docs = \App\Doc::all();
        foreach ($docs as $doc) {
            $doc->status = 'DRAFT';
            $doc->save();
        }
        $folders = docsFolders();
        foreach ($folders as $folder) {
            $files = docFiles($folder);
            echo $folder;
            foreach ($files as $file) {
                if (strpos($file, '.md') !== false) {
                    $record = \App\Doc::where(
                        'path',
                        '=',
                        '/docs/content/' . $folder . '/' . $file
                    )->first();

                    if ($record == null) {
                        $record = new \App\Doc();
                    }
                    $record->slug = $file;
                    $record->path = '/docs/content/' . $folder . '/' . $file;
                    $record->content = file_get_contents(
                        storage_path() .
                            '/docs/content/' .
                            $folder .
                            '/' .
                            $file
                    );
                    $record->status = 'PUBLISHED';
                    $record->save();
                } elseif (
                    $record->content !=
                    file_get_contents(
                        storage_path() .
                            '/docs/content/' .
                            $folder .
                            '/' .
                            $file
                    )
                ) {
                    $record->slug = $file;
                    $record->path = '/docs/content/' . $folder . '/' . $file;
                    $record->content = file_get_contents(
                        storage_path() .
                            '/docs/content/' .
                            $folder .
                            '/' .
                            $file
                    );
                }
                $record->content = file_get_contents(
                    storage_path() . '/docs/content/' . $folder . '/' . $file
                );
                $record->status = 'PUBLISHED';
                $record->save();

                echo (string) $file . " updated ", "\n";
            }
        }
    }
}
