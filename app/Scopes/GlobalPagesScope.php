<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GlobalPagesScope implements Scope
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
        } catch (\Exception $exception) {
        }

        if (\Auth::user()) {
            if (\Auth::user() && \Auth::user()->hasRole('admin')) {
                $builder->withTrashed();
            }
        }
    }
}
