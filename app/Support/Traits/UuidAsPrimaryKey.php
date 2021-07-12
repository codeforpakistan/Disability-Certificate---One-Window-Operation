<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait UuidAsPrimaryKey
{
    protected static function bootUuidAsPrimaryKey() {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}