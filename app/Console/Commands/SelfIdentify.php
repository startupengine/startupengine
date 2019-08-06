<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SelfIdentify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'self:identify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the IP for thea cloud server of this app via Terraformer';

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

            echo "Identifying...\n";

            exec(
                'cd terraform/do; terraform init;'
            );

            $id = exec(
                'cd terraform/do; terraform state list;'
            );

            echo "\nID: " . $id;

            /*exec(
                "cd terraform/do; terraform apply -var 'do_token=". config('terraform.do_token') ."' -auto-approve;  terraform refresh -auto-approve;",
            $output1, $result1);*/

            exec(
                "cd terraform/do; terraform output metadata", $output, $return
            );

            echo "\nMetadata: ";
            print_r(json_decode(json_encode($output)));
            echo "\n";

            return;
        }
        else {
            echo "Error: please set your DIGITAL_OCEAN_API_KEY environment variable.";
            return;
        }
    }
}