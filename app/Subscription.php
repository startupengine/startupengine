<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\IsApiResource;

class Subscription extends Model
{

    use IsApiResource;

    public function transformations(){
        $allowed = ['cancel'];
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
                'requirements' => [
                    'permissions_any' => [
                        'cancel own subscription',
                        'cancel others permission']
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
