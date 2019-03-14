<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncStripeSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncStripeSubscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database entries for all subscriptions in the connected Stripe account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($verbose = null)
    {
        parent::__construct();

        $this->verbose = $verbose;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \Stripe\Stripe::setApiKey(stripeKey('secret'));

        $stripeSubscriptions = \Stripe\Subscription::all(['status' => 'all']);

        if ($this->verbose == true) {
            echo $stripeSubscriptions->data[0];
        }

        if ($stripeSubscriptions != null) {
            foreach ($stripeSubscriptions->data as $stripeSubscription) {
                $subscription = \App\Subscription::where('stripe_id', $stripeSubscription->id)->first();
                if ($subscription  == null) {
                    $subscription  = new \App\Subscription();
                    $subscription ->stripe_id = $stripeSubscription->id;
                }
                $subscription->stripe_plan = $stripeSubscription->plan->id;

                if ($stripeSubscription->status == 'active') {
                    $subscription->status = 'ACTIVE';
                } else {
                    $subscription->status = 'INACTIVE';
                }
                $user = \App\User::where('stripe_id', '=', $stripeSubscription->customer)->first();

                if ($user != null) {
                    $subscription->user_id = $user->id;
                }
                $subscription->save();
                $subscription->details();
                $subscription->save();
            }
        }
        if ($this->verbose == true) {
            echo "\nSynced subscriptions from Stripe account.\n\n";
        }
        return null;
    }
}
