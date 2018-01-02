<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Foundation\Auth\User as AuthUser;
use TCG\Voyager\Traits\VoyagerUser;
use TCG\Voyager\Contracts\User as UserContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends AuthUser implements AuditableContract, UserResolver
{

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

    public function roles()
    {
        return $this->hasMany('\App\Role', 'user_roles');
    }

}