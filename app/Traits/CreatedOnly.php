<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait CreatedOnly
{
    /**
     * Boot functions from Laravel.
     */
    protected static function bootCreatedOnly()
    {
        static::creating(function (Model $model) {
            $model->created_by       = (Auth::user()) ? Auth::user()->id : null;
        });
    }
}
