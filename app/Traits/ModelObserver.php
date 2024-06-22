<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait ModelObserver
{
    /**
     * Boot functions from Laravel.
     */
    protected static function bootModelObserver()
    {
        static::creating(function (Model $model) {
            $model->is_active        = true;
            $model->created_by       = (Auth::user()) ? Auth::user()->id : null;
        });

        static::updating(function (Model $model) {
            $model->updated_by = (Auth::user()) ? Auth::user()->id : null;
        });
    }
}
