<?php

namespace App;

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

}