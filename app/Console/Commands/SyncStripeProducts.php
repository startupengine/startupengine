<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncStripeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncStripeProducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database entries for all products in the connected Stripe account.';

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

        $stripeProducts = \Stripe\Product::all();

        if ($stripeProducts != null) {
            foreach ($stripeProducts->data as $stripeProduct) {
                $product = \App\Product::where(
                    'stripe_id',
                    $stripeProduct->id
                )->first();
                if ($product == null) {
                    $product = new \App\Product();
                    $product->stripe_id = $stripeProduct->id;
                }
                $product->name = $stripeProduct->name;
                if ($stripeProduct->active == true) {
                    $product->status = 'ACTIVE';
                } else {
                    $product->status = 'INACTIVE';
                }

                if ($stripeProduct->metadata['se_json'] != null) {
                    $product->syncFromStripe();
                }
                $product->save();
            }
        }
        echo "\nSynced products from Stripe account.\n\n";
    }
}
