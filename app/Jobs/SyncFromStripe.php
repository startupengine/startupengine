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

        if($this->starting_after == null) {
            $stripeEvents = $stripeModel::all();
        }
        else {
            $stripeEvents = $stripeModel::all(['starting_after' => $this->starting_after]);
        }

        if($stripeEvents!= null && $stripeEvents->data != null){
            foreach($stripeEvents->data as $stripeEvent){
                if($this->type == 'customer') {
                    $object = $localModel::where('email', $stripeEvent->email)->first();
                }
                else {
                    $object = $localModel::where('stripe_id', $stripeEvent->id)->first();
                }
                if($object == null) {
                    $object = new $localModel;
                }
                $object->stripe_id = $stripeEvent->id;
                if($this->type == 'charge') {
                    $object->amount = $stripeEvent->amount;
                    $object->currency = $stripeEvent->currency;
                    $object->description = $stripeEvent->description;
                }
                if($this->type == 'customer') {
                    $object->email = $stripeEvent->email;
                    if($stripeEvent->name != null) {
                        $object->name = $stripeEvent->name;
                    }
                    else {
                        $object->name = 'User';
                    }
                    if($object->password == null){
                        $object->resetPassword();
                    }
                }
                $object->json = json_encode(["remote_data"=>$stripeEvent]);
                $object->save();
            }

            if($stripeEvents->has_more && $stripeEvent != null){
                SyncFromStripe::dispatch($this->type, $stripeEvent->id);
            }

        }
    }
}
