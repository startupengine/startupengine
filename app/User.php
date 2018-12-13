<?php

namespace App;

use App\Traits\IsApiResource;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends AuthUser implements AuditableContract, UserResolver
{

    use Billable;

    use HasRoles;

    use Auditable;

    use Notifiable;

    use SoftDeletes;

    use HasApiTokens;

    use IsApiResource;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Auditable events.
     *
     * @var array
     */
    protected $auditableEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];


    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return \Auth::check() ? \Auth::user()->getAuthIdentifier() : null;
    }

    public function stripeCustomer($token = null)
    {
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        if ($token == null) {
            return \Stripe\Customer::retrieve($this->stripe_id);

        } else {

            $customer = \Stripe\Customer::create(array(
                "description" => "Customer for $this->email",
                "source" => "$token" // obtained with Stripe.js
            ));

            return $customer;
        }
    }

    public function avatar(){
        if($this->avatar !== null && $this->avatar !== "users/default.png"){
            return $this->avatar;
        }
        else {
            return url('/')."/images/avatar.png";
        }

    }

    public function recentEvents(){
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)->whereNotNull("event_data")->where(function ($query) {
            $query->where('event_type', '=', 'page viewed')
                ->orWhere('event_type', '=', 'content viewed')
                ->orWhere('event_type', '=', 'content liked')
                ->orWhere('event_type', '=', 'payment received')
                ->orWhere('event_type', '=', 'payment declined');
        })->orderBy('created_at', 'desc')->limit(10)->get();
        return $events;
    }

    public function recentInterests(){
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)->whereNotNull("event_data")->whereNotNull("event_data->model")->whereNotNull("event_data->model_id")->where(function ($query) {
            $query->where('event_type', '=', 'page viewed')
                ->orWhere('event_type', '=', 'content viewed')
                ->orWhere('event_type', '=', 'content liked')
                ->orWhere('event_type', '=', 'payment received')
                ->orWhere('event_type', '=', 'payment declined');
        })->orderBy('created_at', 'desc')->limit(10)->get();
        $results = [];
        foreach($events as $event){

            $model = json_decode($event->event_data)->model;
            if(strtolower($model) == "page" OR strtolower($model) == "post") {
                $id = json_decode($event->event_data)->model_id;
                $model_name = '\\App\\' . ucfirst($model);
                $model = new $model_name;
                $entry = $model->find($id);
                if ($entry !== null && !$entry->existingTags()->isEmpty()) {
                    foreach ($entry->existingTags() as $tag) {
                        $results[$tag->name] = ["slug" => $tag->slug, "name" => $tag->name];
                    }
                }
            }

        }
        return $results;
    }

    public function recentPayments(){
        $id = $this->id;
        $today =  \Carbon\Carbon::now();
        $aMonthAgo =  \Carbon\Carbon::now()->subDays(30);
        $events = AnalyticEvent::where('user_id', '=', $id)->where('event_type', '=', 'payment received')->where('event_data->model', 'product')->whereBetween('created_at', [$aMonthAgo->toDateTimeString(), $today->toDateTimeString()])->get();
        $events->transform(function ($item, $key) {
            $item->amount = json_decode($item->event_data)->amount;
            return $item;
        });
        return $events->sum('amount');
    }

    public function recentCosts(){
        $id = $this->id;
        $today =  \Carbon\Carbon::now();
        $aMonthAgo =  \Carbon\Carbon::now()->subDays(30);
        $events = AnalyticEvent::where('user_id', '=', $id)->where('event_type', '=', 'cost incurred')->whereNotNull('event_data->cost')->whereBetween('created_at', [$aMonthAgo->toDateTimeString(), $today->toDateTimeString()])->get();
        $events->transform(function ($item, $key) {
            $item->cost = json_decode($item->event_data)->cost;
            return $item;
        });
        return $events->sum('cost');
    }

    public function lifeTimeValue(){
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)->where('event_type', '=', 'payment received')->where('event_data->model', 'product')->get();
        $events->transform(function ($item, $key) {
            $item->amount = json_decode($item->event_data)->amount;
            return $item;
        });
        return $events->sum('amount');
    }

    public function searchFields() {
        return ['name', 'email'];
    }

    public function topPages(){
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)->where('event_type', '=', 'page viewed')->where('event_data->model', 'page')->get();
        $pages = [];
        foreach($events as $event) {
            $id = json_decode($event->event_data)->model_id;
            $page = Page::where('id', '=', $id)->first();
            $pages[] = $page;
        }
        $pages = array_slice($pages, 0, 10);
        return $pages;
    }


    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/user.json');
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