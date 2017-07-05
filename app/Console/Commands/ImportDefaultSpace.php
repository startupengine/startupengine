<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDefaultSpace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ImportDefaultSpace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the default space into Contentful.';

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
        $output = $contentful->import();
        echo implode($output, " \n");
        echo "\nCurrent space imported into Contentful.\n";
    }
}
