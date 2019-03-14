<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ContainerCLI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cli:Container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch CLI for Docker container';

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
        echo "\n";
        echo 'To access the container CLI, run:';
        echo "\n cd laradock";
        echo "\n docker-compose exec php-fpm bash";
        echo "\n";
        echo "\n";
    }
}
