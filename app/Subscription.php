<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }

    public function user(){
        $user = \App\User::where('id', '=', $this->user_id)->first();
        return $user;
    }
}
