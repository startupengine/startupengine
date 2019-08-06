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

        exec(
            'cd terraform/do; terraform init;'
        );

        $id = exec(
            'cd terraform/do; terraform state list;'
        );

        echo "\nID: " . $id;

        exec(
            "cd terraform/do; terraform apply; terraform refresh; "
        );

        exec(
            "cd terraform/do; terraform output ip", $output, $return
        );

        $output = implode(" ",$output);

        //echo "\nIP: " . $output;

        exec(
            "cd terraform/do; terraform output price_monthly", $output, $return
        );

        $output = implode(" ",$output);

        //echo "\nPrice Monthly: " . $output;

        exec(
            "cd terraform/do; terraform output metadata", $output, $return
        );

        echo "\nMetadata: ";
        print_r($output);
        echo "\n";

        return;
    }
}