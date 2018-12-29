<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StopContainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stop:Container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop Docker container';

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
        exec('cd laradock; docker-compose down');
    }
}
