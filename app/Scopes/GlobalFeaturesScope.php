<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GlobalFeaturesScope implements Scope
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
                if (\Auth::user()->hasPermissionTo('browse features')) {
                    $this->hasPermission = 'browse features';
                } else {
                    $this->hasPermission = null;
                }
            }
        } catch (\Exception $exception) {
        }

        if (!\Auth::user()) {
            $builder->where('status', '=', 'PUBLISHED');
        }
    }
}
