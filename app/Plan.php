<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use \Altek\Accountant\Recordable;

    use SoftDeletes;
    use IsApiResource;

    //protected $with = ['schema'];

    protected $fillable = [
        'name',
        'price',
        'interval',
        'description',
        'product_id'
    ];

    public function json()
    {
        $json = json_decode($this->json);
        return $json;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/plan.json');
        $schema = json_decode($path);
        return $schema;
    }
}
