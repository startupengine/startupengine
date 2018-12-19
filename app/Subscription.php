<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\IsApiResource;

class Subscription extends Model
{

    use IsApiResource;

    public function transformations(){
        $allowed = ['switchPlan', 'cancel'];
        $results = [];
        foreach($allowed  as $function){
            $results[$function] = $this->$function('schema');
        }
        return $results;
    }

    public function cancel($input = null){
        if($input == 'schema'){
            $schema = [
                'label' => 'Cancel',
                'slug' => 'cancel',
                'description' => 'Cancel this subscription.',
                'require_confirmation' => true,
                'confirmation_message' => 'Are you sure you want to cancel this subscription?',
                'success_message' => "Subscription $this->stripe_id cancelled.",
                'requirements' => [
                    'permissions_any' => [
                        'cancel own subscription',
                        'cancel others subscription']
                ]
            ];
            return $schema;
        }
        else{
            //Do Something
            //dump("Subscription #$this->id (Stripe ID: $this->stripe_id) Cancelled)");
        }
    }

    public function switchPlan($input = null){
        if($input == 'schema'){
            $schema = [
                'label' => 'Switch Plan',
                'slug' => 'switchPlan',
                'description' => 'Switch this subscription to another plan.',
                'instruction' => 'Select a new plan.',
                'confirmation_message' => null,
                'options' => [
                    'value-1' => [
                        'label'=> 'Value 1',
                        'selected' => true,
                        'description'=> 'This is a good choice...'
                    ],
                    'value-2' => [
                        'label'=> 'Value 2',
                        'description'=> 'This is a good choice...'
                    ]
                ],
                'success_message' => "Subscription $this->stripe_id successfully changed.",
                'requirements' => [
                    'permissions_any' => [
                        'change own subscription',
                        'change others subscription']
                ]
            ];
            return $schema;
        }
        else{
            //Do Something
            //dump("Subscription #$this->id (Stripe ID: $this->stripe_id) Cancelled)");
        }
    }

    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }

    public function user(){
        $user = \App\User::where('id', '=', $this->user_id)->first();
        return $user;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/subscription.json');
        $schema = json_decode($path);
        return $schema;
    }

    public function content()
    {
        $json = $this->json;
        if(gettype($json) !== 'object') {
            $json = json_decode($json, true);
        }
        return $json;
    }
}
