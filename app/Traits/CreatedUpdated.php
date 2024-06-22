<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait CreatedUpdated
{
    /**
     * Boot functions from Laravel.
     */
    protected static function bootCreatedUpdated()
    {
        static::creating(function (Model $model) {
            $model->created_by       = (Auth::user()) ? Auth::user()->id : null;
        });

        static::updating(function (Model $model) {
            $model->updated_by = (Auth::user()) ? Auth::user()->id : null;
        });
    }
}
