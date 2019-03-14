<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GlobalPostsScope implements Scope
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
                if (\Auth::user()->hasPermissionTo('browse posts')) {
                    $this->hasPermission = 'browse posts';
                } elseif (\Auth::user()->hasPermissionTo('browse own posts')) {
                    $this->hasPermission = 'browse own posts';
                }
            }
        } catch (\Exception $exception) {
        }

        if (\Auth::user()) {
            if ($this->hasPermission == 'browse own posts') {
                $builder->where('author_id', '=', \Auth::user()->id);
            }
            if ($this->hasPermission == 'browse posts') {
                $builder->where('status', '=', 'PUBLISHED');
                $builder->orWhere('status', '=', 'PENDING');
                $builder->orWhere('status', '=', 'UNPUBLISHED');
                $builder->orWhere('status', '=', 'DRAFT');
            }
        } else {
            $builder->where('status', '=', 'PUBLISHED');
        }
    }
}
