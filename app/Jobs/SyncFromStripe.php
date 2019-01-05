<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncFromStripe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $type;
    public $starting_after;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type = 'charge', $starting_after = null)
    {
        $this->type = $type;
        $this->starting_after = $starting_after;
        //dump($this->type);
        ///dump($this->starting_after);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Stripe\Stripe::setApiKey(stripeKey('secret'));

        if($this->type == 'charge'){
            $stripeModel = "\\Stripe\\Charge";
            $localModel = "\\App\\Payment";
        }
        if($this->type == 'customer'){
            $stripeModel  = "\\Stripe\\Customer";
            $localModel = "\\App\\User";
        }
        if($this->type == 'product'){
            $stripeModel  = "\\Stripe\\Product";
            $localModel = "\\App\\Product";
        }
        if($this->type == 'plan'){
            $stripeModel  = "\\Stripe\\Plan";
            $localModel = "\\App\\Plan";
        }
        if($this->type == 'subscription'){
            $stripeModel = "\\Stripe\\Subscription";
            $localModel = "\\App\\Subscription";
        }
        if($this->starting_after == null) {
            $stripeObjects = $stripeModel::all();
        }
        else {
            $stripeObjects = $stripeModel::all(['starting_after' => $this->starting_after]);
        }

        if($stripeObjects!= null && $stripeObjects->data != null){
            foreach($stripeObjects->data as $stripeObject){
                if($this->type == 'customer') {
                    $object = $localModel::where('email', $stripeObject->email)->first();
                }
                else {
                    $object = $localModel::where('stripe_id', $stripeObject->id)->first();
                }
                if($object == null) {
                    $object = new $localModel;
                }
                $object->stripe_id = $stripeObject->id;
                if($this->type == 'charge') {
                    $object->amount = $stripeObject->amount;
                    $object->currency = $stripeObject->currency;
                    $object->description = $stripeObject->description;
                }
                if($this->type == 'product') {
                    $object->description = $stripeObject->description;
                    $object->name = $stripeObject->name;
                }
                if($this->type == 'subscription') {
                    $user = \App\User::where('stripe_id', $stripeObject->customer)->first();
                    if($user != null){
                        $object->user_id = $user->id;
                    }
                    $user = null;
                    if($stripeObject->plan != null){
                        $object->stripe_plan = $stripeObject->plan->id;
                    }
                    if($stripeObject->status == 'active'){
                        $object->status = 'ACTIVE';
                    }
                    else {
                        $object->status = 'INACTIVE';
                    }
                }
                if($this->type == 'plan') {
                    $object->name = $stripeObject->name;
                    $object->description = $stripeObject->description;
                    $object->price = $stripeObject->amount;
                    $object->interval = $stripeObject->interval;
                    $product = \App\Product::where('stripe_id', $stripeObject->product)->first();
                    $object->product_id = $product->id;
                    $product = null;
                    if($stripeObject->active == true){
                        $object->status = 'ACTIVE';
                    }
                    else {
                        $object->status = 'INACTIVE';
                    }
                }
                if($this->type == 'customer') {
                    $object->email = $stripeObject->email;
                    if($stripeObject->name != null) {
                        $object->name = $stripeObject->name;
                    }
                    else {
                        $object->name = 'User';
                    }
                    if($object->password == null){
                        $object->resetPassword();
                    }
                }
                if($stripeObject->metadata['se_json'] != null){
                    $object->forceFill([
                        'json' => $stripeObject->metadata['se_json']
                    ]);
                }
                $object->forceFill([
                    'json->remote_data' => json_decode(json_encode($stripeObject))
                ]);
                $object->save();
            }

            if($stripeObjects->has_more && $stripeObject != null){
                SyncFromStripe::dispatch($this->type, $stripeObject->id);
            }

        }
    }
}
