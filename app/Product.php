<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use App\Traits\RelationshipsTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

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

    public function transformations(){

        $allowed = [];
        if($this->status == 'ACTIVE'){
            $allowed[] = 'subscribe';
        }

        $results = [];
        foreach($allowed  as $function){
            $results[$function] = $this->$function('schema');
        }
        return $results;
    }

    public function details(){
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        $object = \Stripe\Product::retrieve($this->stripe_id);
        return $object;
    }

    public function stripePlans(){
        $product_id = ($this->stripe_id);
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        $plans= \Stripe\Plan::all(["product" => $product_id ]);
        return $plans;
    }

    public function subscribe($input = null){
        if($input == 'schema'){
            $plans = $this->stripePlans()->data;
            $options = [];
            if($plans != null){

                foreach($plans as $plan){
                    $item =[];
                    $item['value'] = $plan->id;
                    $item['label'] = $plan->nickname;
                    $amount = "$".$plan->amount/100 ." ". strtoupper($plan->currency);
                    $item['description'] = $amount. " / " . ucwords($plan->interval);
                    $options[$plan->id] = $item;

                }
            }
            $schema = [
                'label' => 'Subscribe',
                'slug' => 'Subscribe',
                'description' => 'You may subscribe to this product.',
                'instruction' => 'Select a plan.',
                'confirmation_message' => null,
                'options' => $options,
                'success_message' => "Subscription successfully created.",
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
            $userId = app('request')->input('user_id');
            $planId = app('request')->input('action');
            if($userId != null) {
                $user = \App\User::find($userId);
                //dump($user);
                if($user != null) {
                    \Stripe\Stripe::setApiKey(stripeKey('secret'));

                    $subscription = $this->details();
                    $newStripeSubscription = \Stripe\Subscription::create([
                        "customer" => $user->stripe_id,
                        "items" => [
                            [
                                "plan" => $planId
                            ],
                        ]
                    ]);
                    Artisan::call("command:SyncStripeSubscriptions");

                }

            }
        }
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