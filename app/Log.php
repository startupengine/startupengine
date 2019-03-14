<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //

    use IsApiResource;

    protected $table = 'telescope_entries';
    protected $primaryKey= 'sequence';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
        'uuid' => 'string'
    ];



    public function getIdAttribute(){
        //return json_decode(json_encode($this->uuid));
        return $this->getKey();
    }

    public function description(){
        if($this->type == 'exception') {
            return $this->content['class'];
        }
        if($this->type == 'cache') {
            return $this->content['key'];
        }
        if($this->type == 'query') {
            return $this->content['sql'];
        }
        if($this->type == 'request') {
            return $this->content['uri'];
        }
        else {
            return null;
        }
    }

    public function searchFields() {
        return ['type', 'content'];
    }

    public function occurrences($hours = 1)
    {

        if($this->type == 'exception') {
            $occurrences = \App\Log::where('created_at', '>=', \Carbon\Carbon::now()->subHours($hours))->whereJsonContains('content->class', $this->content['class'])->get();
        }
        elseif($this->type == 'cache') {
            $occurrences = \App\Log::where('created_at', '>=', \Carbon\Carbon::now()->subHours($hours))->whereJsonContains('content->key', $this->content['key'])->get();
        }
        elseif($this->type == 'request') {
            $occurrences = \App\Log::where('created_at', '>=', \Carbon\Carbon::now()->subHours($hours))->whereJsonContains('content->uri', $this->content['uri'])->get();
        }
        elseif($this->type == 'query') {
            $occurrences = \App\Log::where('created_at', '>=', \Carbon\Carbon::now()->subHours($hours))->whereJsonContains('content->uri', $this->content['sql'])->get();
        }
        else { $occurrences = null; }

        return $occurrences;
    }

    public function content(){
        return json_decode(json_encode($this->content));
    }


    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/log.json');
        $schema = json_decode($path);
        return $schema;
    }
}
