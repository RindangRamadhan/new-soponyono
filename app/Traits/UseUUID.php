<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UseUUID
{
    /**
     * Boot function from Laravel.
     */
    protected static function bootUseUUID()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Tell Laravel that the key type is a string, not an integer.
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Tell Laravel that the key is of type string.
     */
    public function getKeyType()
    {
        return 'string';
    }
}
