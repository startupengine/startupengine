<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;

class RelaunchContainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relaunch:Container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-launch Docker container & open browser';

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
        Artisan::queue('stop:Container');
        Artisan::queue('launch:Container');
    }
}
