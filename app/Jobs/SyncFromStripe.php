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
        //
        $this->type = $type;
        $this->starting_after = $starting_after;
        dump($this->type);
        dump($this->starting_after);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Stripe\Stripe::setApiKey(stripeKey('secret'));

        if($this->starting_after == null) {
            $stripeEvents = \Stripe\Charge::all();
        }
        else {
            $stripeEvents = \Stripe\Charge::all(['starting_after' => $this->starting_after]);
        }

        if($stripeEvents!= null){
            foreach($stripeEvents->data as $stripeEvent){
                $payment = \App\Payment::where('stripe_id', $stripeEvent->id)->first();
                if($payment == null) {
                    $payment = new \App\Payment;
                }
                $payment->stripe_id = $stripeEvent->id;
                $payment->amount = $stripeEvent->amount;
                $payment->currency = $stripeEvent->currency;
                $payment->description = $stripeEvent->description;
                $payment->json = json_encode(["remote_data"=>$stripeEvent]);
                $payment->save();
            }


            if($stripeEvents->has_more && $stripeEvent != null){
                SyncFromStripe::dispatch($this->type, $stripeEvent->id);
            }

        }
    }
}
