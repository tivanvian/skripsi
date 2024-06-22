<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        $creationCallback = function ($model) {
            if (empty($model->{$model->getKeyName()}))
            {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        };

        static::creating($creationCallback);
    }

   /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing() : bool
    {
        return false;
    }


    /**
     * Tell laravel that the key type is a string, not an integer.
     *
     * @return string
     */
    public function getKeyType() : string
    {
        return 'string';
    }
}
