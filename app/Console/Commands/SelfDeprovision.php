<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SelfDeprovision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'self:deprovision';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy the cloud server for this app via Terraformer';

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

            echo "Deprovisioning...\n";

            exec(
                "cd terraform/do; terraform destroy -var 'do_token=". config('terraform.do_token') ."' -auto-approve;"
                , $output, $result);

            echo "Result Code: $result\n";

            return $output;
        }

        else {
            echo "Error: please set your DIGITAL_OCEAN_API_KEY environment variable.";
            return;
        }
    }
}
