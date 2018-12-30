<?php

namespace App\Console\Commands;

use App\Jobs\SyncFromStripe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SyncStripeEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncStripeEvents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database entries for all events in the connected Stripe account.';

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

        SyncFromStripe::dispatch();

        echo "\nSynced events from Stripe account.\n\n";
    }
}