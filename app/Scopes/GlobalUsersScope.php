<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GlobalUsersScope implements Scope
{
    protected $hasPermission = false;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        try {
            if (\Auth::user()) {
                if (\Auth::user()->hasPermissionTo('browse users')) {
                    $this->hasPermission = 'browse users';
                }
            }
        } catch (\Exception $exception) {
        }

        if (\Auth::user()) {
            if ($this->hasPermission == 'browse users') {
                $builder->where('id', '=', '*');
            } else {
                $builder->where('id', '=', \Auth::user()->id);
            }
        } else {
            $builder->where('id', '=', 0);
        }
    }
}
