<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\IsApiResource;

class Subscription extends Model
{

    use IsApiResource;

    protected $casts = ['json' => 'array'];

    public function transformations()
    {

        $allowed = [];

        if ($this->status == 'ACTIVE') {
            $allowed[] = 'switchPlan';
            $allowed[] = 'cancel';
        }

        $results = [];
        foreach ($allowed as $function) {
            $results[$function] = $this->$function('schema');
        }
        return $results;
    }

    public function details($refresh = null, $object = null)
    {

        if ($refresh == true OR $this->content() == null OR ($this->content() != null && !isset($this->content()->remote_data))) {
            \Stripe\Stripe::setApiKey(stripeKey('secret'));
            $details = \Stripe\Subscription::retrieve($this->stripe_id);
            $product = \Stripe\Product::retrieve($details->plan->product);
            $this->forceFill([
                'json->remote_data' => [
                    "subscription" => $details,
                    "product" => $product

                ]
            ]);
            //dump($details);
            if ($details->status != 'active') {
                $this->status = "INACTIVE";
                if($details->canceled_at != null) {
                    $this->ends_at = \Carbon\Carbon::createFromTimestamp($details->canceled_at)->toDateTimeString();
                }
            }
            else {
                $this->status = 'ACTIVE';
                $this->ends_at = null;
            }
            $this->save();
            //dd($this->json);
            if($object != null){
             return $details;
            }
            else {
                return $this->content()->remote_data;
            }
        } else {

            return $this->content()->remote_data;
        }
    }

    public function content()
    {
        $json = $this->json;

        if (gettype($json) == 'string') {
            $json = json_decode($json, true);
        }
        if (gettype($json) == 'object' OR gettype($json) == 'array') {

            $json = json_decode(json_encode($json));

        }
        return $json;
    }

    public function cancel($input = null)
    {
        if ($input == 'schema') {
            $schema = [
                'label' => 'Cancel',
                'slug' => 'cancel',
                'description' => 'Cancel this subscription.',
                'require_confirmation' => true,
                'confirmation_message' => 'Are you sure you want to cancel this subscription?',
                'success_message' => "Subscription cancelled.",
                'requirements' => [
                    'permissions_any' => [
                        'cancel own subscription',
                        'cancel others subscription']
                ]
            ];
            return $schema;
        } else {
            \Stripe\Stripe::setApiKey(stripeKey('secret'));

            $subscription = $this->details(true, true);
            $subscription->cancel();
            $this->status = 'INACTIVE';
            $this->ends_at = \Carbon\Carbon::now()->toDateTimeString();
            $this->save();
        }
    }

    public function switchPlan($input = null)
    {
        if ($input == 'schema') {
            $plans = $this->plans()->data;
            $options = [];
            if ($plans != null) {

                foreach ($plans as $plan) {
                    $item = [];
                    $item['value'] = $plan->id;
                    $item['label'] = $plan->nickname;
                    $amount = "$" . $plan->amount / 100 . " " . strtoupper($plan->currency);
                    $item['description'] = $amount . " / " . ucwords($plan->interval);
                    $options[$plan->id] = $item;

                }
            }
            $schema = [
                'label' => 'Switch Plan',
                'slug' => 'switchPlan',
                'description' => 'You may switch to another subscription plan.',
                'instruction' => 'Select a new plan.',
                'confirmation_message' => null,
                'options' => $options,
                'success_message' => "Subscription successfully changed.",
                'requirements' => [
                    'permissions_any' => [
                        'change own subscription',
                        'change others subscription']
                ]
            ];
            return $schema;
        } else {
            //Do Something
            \Stripe\Stripe::setApiKey(stripeKey('secret'));

            $subscription = $this->details();
            //dd($subscription->subscription);
            \Stripe\Subscription::update($this->stripe_id, [
                'cancel_at_period_end' => false,
                'items' => [
                    [
                        'id' => $subscription->subscription->items->data[0]->id,
                        'plan' => $input,
                    ],
                ],
            ]);
        }
    }

    public function plans()
    {
        $product_id = ($this->details(true)->subscription->plan->product);
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        $plans = \Stripe\Plan::all(["product" => $product_id]);
        return $plans;
    }



    public function user()
    {
        $user = \App\User::where('id', '=', $this->user_id)->first();
        return $user;
    }

    public function product()
    {
        $product_id = ($this->details()->plan->product);
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        $product = \Stripe\Product::retrieve(["id" => $product_id]);
        return $product;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/subscription.json');
        $schema = json_decode($path);
        return $schema;
    }
}
