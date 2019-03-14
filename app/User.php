<?php

namespace App;

use App\Traits\IsApiResource;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Passport;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravolt\Avatar\Facade as Avatar;
use Altek\Accountant\Contracts\Identifiable as Identifiable;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends AuthUser implements
    AuditableContract,
    UserResolver,
    Identifiable,
    Recordable,
    MustVerifyEmail
{
    use \Altek\Accountant\Recordable;

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
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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
        'deleted_at'
    ];

    /**
     * Auditable events.
     *
     * @var array
     */
    protected $auditableEvents = ['created', 'updated', 'deleted', 'restored'];

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return \Auth::check() ? \Auth::user()->getAuthIdentifier() : null;
    }

    public function subscriptions()
    {
        return $this->hasMany(\App\Subscription::class);
    }

    public function stripeCustomer($source = null)
    {
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        if ($source == null) {
            $customer = \Stripe\Customer::retrieve($this->stripe_id);
            return $customer;
        } else {
            $customer = \Stripe\Customer::create([
                "description" => "Customer for $this->email",
                "source" => "$source", // obtained with Stripe.js
                "email" => $this->email
            ]);

            $this->stripe_id = $customer->id;
            $this->save();

            return $customer;
        }
    }

    public function avatar()
    {
        if ($this->avatar !== null && $this->avatar !== "users/default.png") {
            return $this->avatar;
        } else {
            return Avatar::create($this->name)->toBase64();
            //return url('/')."/images/avatar.png";
        }
    }

    public function recentEvents()
    {
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->whereNotNull("event_data")
            ->where(function ($query) {
                $query
                    ->where('event_type', '=', 'page viewed')
                    ->orWhere('event_type', '=', 'content viewed')
                    ->orWhere('event_type', '=', 'content liked')
                    ->orWhere('event_type', '=', 'payment received')
                    ->orWhere('event_type', '=', 'payment declined');
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        return $events;
    }

    public function recentInterests()
    {
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->whereNotNull("event_data")
            ->whereNotNull("event_data->model")
            ->whereNotNull("event_data->model_id")
            ->where(function ($query) {
                $query
                    ->where('event_type', '=', 'page viewed')
                    ->orWhere('event_type', '=', 'content viewed')
                    ->orWhere('event_type', '=', 'content liked')
                    ->orWhere('event_type', '=', 'payment received')
                    ->orWhere('event_type', '=', 'payment declined');
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        $results = [];
        foreach ($events as $event) {
            $model = json_decode($event->event_data)->model;
            if (strtolower($model) == "page" or strtolower($model) == "post") {
                $id = json_decode($event->event_data)->model_id;
                $model_name = '\\App\\' . ucfirst($model);
                $model = new $model_name();
                $entry = $model->find($id);
                if ($entry !== null && !$entry->existingTags()->isEmpty()) {
                    foreach ($entry->existingTags() as $tag) {
                        $results[$tag->name] = [
                            "slug" => $tag->slug,
                            "name" => $tag->name
                        ];
                    }
                }
            }
        }
        return $results;
    }

    public function recentPayments()
    {
        $id = $this->id;
        $today = \Carbon\Carbon::now();
        $aMonthAgo = \Carbon\Carbon::now()->subDays(30);
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->where('event_type', '=', 'payment received')
            ->where('event_data->model', 'product')
            ->whereBetween('created_at', [
                $aMonthAgo->toDateTimeString(),
                $today->toDateTimeString()
            ])
            ->get();
        $events->transform(function ($item, $key) {
            $item->amount = json_decode($item->event_data)->amount;
            return $item;
        });
        return $events->sum('amount');
    }

    public function recentCosts()
    {
        $id = $this->id;
        $today = \Carbon\Carbon::now();
        $aMonthAgo = \Carbon\Carbon::now()->subDays(30);
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->where('event_type', '=', 'cost incurred')
            ->whereNotNull('event_data->cost')
            ->whereBetween('created_at', [
                $aMonthAgo->toDateTimeString(),
                $today->toDateTimeString()
            ])
            ->get();
        $events->transform(function ($item, $key) {
            $item->cost = json_decode($item->event_data)->cost;
            return $item;
        });
        return $events->sum('cost');
    }

    public function lifeTimeValue()
    {
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->where('event_type', '=', 'payment received')
            ->where('event_data->model', 'product')
            ->get();
        $events->transform(function ($item, $key) {
            $item->amount = json_decode($item->event_data)->amount;
            return $item;
        });
        return $events->sum('amount');
    }

    public function searchFields()
    {
        return ['name', 'email'];
    }

    public function charges()
    {
        \Stripe\Stripe::setApiKey(stripeKey('secret'));
        $results = \Stripe\Charge::all([
            "customer" => $this->stripe_id,
            "limit" => 100
        ]);
        return $results;
    }

    public function topPages()
    {
        $id = $this->id;
        $events = AnalyticEvent::where('user_id', '=', $id)
            ->where('event_type', '=', 'page viewed')
            ->where('event_data->model', 'page')
            ->get();
        $pages = [];
        foreach ($events as $event) {
            $id = json_decode($event->event_data)->model_id;
            $page = Page::where('id', '=', $id)->first();
            $pages[] = $page;
        }
        $pages = array_slice($pages, 0, 10);
        return $pages;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/user.json');
        $schema = json_decode($path);
        return $schema;
    }

    public function content()
    {
        $json = $this->json;
        if (gettype($json) !== 'object') {
            $json = json_decode($json, true);
        }
        return $json;
    }

    public function webAppToken()
    {
        $token = \App\OAuthToken::where('user_id', $this->id)
            ->where('client_id', 1)
            ->first();
        if ($token == null) {
            $newToken = $this->createToken('Web App')->accessToken;

            $token = \App\OAuthToken::where('user_id', $this->id)
                ->where('client_id', 1)
                ->first();
            $token->token = $newToken;
        }
        $token->expires_at = \Carbon\Carbon::now()
            ->addDays(3)
            ->toDateTimeString();
        $token->save();
        return $token->token;
    }

    public function resetPassword()
    {
        $this->password = Hash::make(str_random(11));
        $this->save();
    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function addSubscription(Request $request)
    {
    }
}
