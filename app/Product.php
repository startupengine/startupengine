<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use App\Traits\RelationshipsTrait;
use Carbon\Carbon;

class Product extends Model
{

    use RelationshipsTrait;

    use EloquentJoin;

    use Taggable;

    use SoftDeletes;

    use IsApiResource;

    protected $useTableAlias = false;
    protected $appendRelationsCount = false;
    protected $leftJoin = false;
    protected $aggregateMethod = 'MAX';

    protected $guarded = [];
    protected $fillable = ['name', 'slug', 'json', 'status'];

    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }

    public function searchFields() {
        return ['slug', 'name', 'description', 'json->sections->about->fields->type', 'json->sections->about->fields->description'];
    }

    public function thumbnail(){
        if($this->schema() != null && $this->schema()->sections != null){
            foreach($this->schema()->sections as $section){
                if($section->fields != null){
                    foreach ($section->fields as $field => $value) {

                        if(isset($value->isThumbnail) && $value->isThumbnail == true) {
                            $slug = $section->slug;
                            $string = "sections->".$slug."->fields->".$field;
                            //dd($this->content()->sections->$slug->fields->$field);
                            if($this->content() != null && $this->content()->sections != null && $this->content()->sections->$slug != null && $this->content()->sections->$slug->fields != null && isset($this->content()->sections->$slug->fields->$field)) {
                                return $this->content()->sections->$slug->fields->$field;
                            }
                            else { return null; }

                        }
                    }
                }
            }
        }

    }

    public function content()
    {

        $json = $this->json;
        if(gettype($json) == 'string') {
            $json = json_decode($json);
        }
        return $json;

    }

    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/product.json');
        $schema = json_decode($path);
        return $schema;
    }

    public function plans(){
        $plans = \App\Plan::where('product_id', '=', $this->id)->orderBy('price', 'asc')->get();
        foreach($plans as $plan){
            $plan->schema = $plan->schema();
        }
        return $plans;
    }

    public function purchases(){
        $request = request();
        if($request->input('startDate') != null){
            $startDate = \Carbon\Carbon::parse($request->input('startDate'));
        }
        else {
            $startDate = new Carbon();
            $startDate = $startDate->subDays(30);
        }
        if($request->input('endDate') != null){
            $endDate = \Carbon\Carbon::parse($request->input('endDate'));
        }
        else {
            $endDate = new Carbon();
        }
        $purchases = $this->hasMany('App\AnalyticEvent', 'model_id')->where('event_type', '=', 'product purchased')->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
        //dd($purchases->get());
        return $purchases;
    }

}