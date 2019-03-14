<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $table = 'preference_schemas';

    use IsApiResource;

    public function overRideEdit()
    {
        return true;
    }


    public function objectToEdit()
    {
        if (app('request')->input('user_id') != null) {
            $userId = app('request')->input('user_id');
            return $this->child($userId);
        }
    }

    public function child($userId)
    {
        $user = \App\User::find($userId);
        $preference = \App\Preference::where('user_id', $userId)->where('preference_schema_id', $this->id)->orderBy('created_at')->first();
        if ($preference == null) {
            $preference = new \App\Preference();
            $preference->preference_schema_id = $this->id;
            $preference->user_id = $userId;
            $preference->save();
        }
        return $preference;
    }

    public function content($userId)
    {
        $user = \App\User::find($userId);
        if ($user != null) {
            $preference = \App\Preference::where('user_id', $userId)->where('preference_schema_id', $this->id)->orderBy('created_at')->first();
            //dd($preference);
        }
        if ($preference != null) {
            $json = $preference->content();
        } else {
            $json = null;
        }
        return $json;
    }

    public function schema()
    {
        if (gettype($this->json) == 'string') {
            return json_decode($this->json, true);
        } else {
            return $this->json;
        }
    }
}
