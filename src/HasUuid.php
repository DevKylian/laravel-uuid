<?php

namespace DevKylian\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Trait HasUuid
 * @package DevKylian\Uuid
 */
trait HasUuid
{
    protected $isLockedUuid = true;

    /**
     * Used by Eloquent to get primary key type.
     * UUID Identified as a string.
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Used by Eloquent to get if the primary key is auto increment value.
     * UUID is not.
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Add behavior to creating and saving Eloquent events.
     * @return void
     */
    public static function bootHasUuid()
    {
        // Create a UUID to the model if it does not have one
        static::creating(function (Model $model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });

        static::saving(function (Model $model) {
            $baseID = $model->getOriginal('id');
            if (!is_null($baseID) && $model->isLockedUuid) {
                if ($baseID !== $model->id) {
                    $model->id = $baseID;
                }
            }
        });
    }
}
