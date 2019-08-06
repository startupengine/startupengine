<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SelfOrchestrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'self:orchestrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Orchestrate a cloud server for this app via Terraformer';

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

        if(config('terraform.do_token') != null) {

            echo "Provisioning a server...\n";

            exec(
                'cd terraform/do; terraform init;'
            );

            $ip = exec(
                "cd terraform/do; terraform apply -var 'do_token=". config('terraform.do_token') ."' -auto-approve;"
            , $output, $result);

            echo "Result code: $result";

            return;
        }
        else {
            echo "Error: please set your DIGITAL_OCEAN_API_KEY environment variable.";
            return;
        }
    }
}
