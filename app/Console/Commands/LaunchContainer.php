<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LaunchContainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'launch:Container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch Docker container & open browser';

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
        exec('cd laradock; docker-compose up -d nginx postgres; sleep 10; open http://startupengine.test');
    }
}
