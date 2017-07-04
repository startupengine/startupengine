<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportContentfulSpace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ExportContentfulSpace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export site content to local storage.';

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
        $contentful = new \App\Contentful;
        $output = $contentful->export();
        echo implode($output, " \n");
        echo "\nCurrent space exported from Contentful.\n";
    }
}
