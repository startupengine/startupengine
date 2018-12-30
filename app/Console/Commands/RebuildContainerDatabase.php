<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan as Artisan;

class RebuildContainerDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebuild:ContainerDatabase';

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
        exec('cd laradock; docker-compose exec php-fpm php artisan migrate:fresh --seed');
        exec('cd laradock; docker-compose exec php-fpm php artisan command:SyncStripeProducts');
        echo ("\nRebuilt database.\n\n");
    }
}
