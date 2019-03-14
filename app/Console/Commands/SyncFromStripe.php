<?php

namespace App\Console\Commands;

use App\Jobs\SyncFromStripe as SyncFromStripeJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SyncFromStripe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncFromStripe {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database entries for objects in the connected Stripe account.';

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
        $type = $this->argument('type');
        if ($type == null) {
            $type = 'charge';
        }
        echo "\nSyncing $type objects from Stripe.\n";

        SyncFromStripeJob::dispatch($type);

        echo "\nSynced $type objects.\n\n";
    }
}
