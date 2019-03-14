<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SyncStripeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncStripeUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database entries for all customers in the connected Stripe account.';

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
        \Stripe\Stripe::setApiKey(stripeKey('secret'));

        $stripeCustomers = \Stripe\Customer::all();

        if ($stripeCustomers != null) {
            foreach ($stripeCustomers->data as $stripeCustomer) {
                $user = \App\User::where(
                    'email',
                    $stripeCustomer->email
                )->first();
                if ($user == null) {
                    $user = new \App\User();
                }
                $user->stripe_id = $stripeCustomer->id;
                $user->email = $stripeCustomer->email;
                if ($stripeCustomer->name != null) {
                    $user->name = $stripeCustomer->name;
                } else {
                    $user->name = "User";
                }

                if ($user->password == null) {
                    $user->password = Hash::make(str_random(11));
                }

                if ($stripeCustomer->metadata['se_json'] != null) {
                    $user->syncFromStripe();
                }
                $user->save();
            }
        }
        echo "\nSynced users from Stripe account.\n\n";
    }
}
