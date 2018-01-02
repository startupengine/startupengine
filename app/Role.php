<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
    use SoftDeletes;

    use Auditable;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('\App\User', 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany('\App\Permission');
    }
}
