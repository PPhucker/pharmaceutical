<?php

namespace App\Helpers;

class Model
{
    /**
     * Возвращает измененные атрибуты модели.
     *
     * @param $model
     *
     * @return array
     */
    public static function getDirtyAttributes($model)
    {
        $changedAttributes = [];

        foreach ($model->getDirty() as $attribute => $value) {
            $changedAttributes[$attribute] = [
                'before' => $model->getOriginal($attribute),
                'after' => $value
            ];
        }

        return $changedAttributes;
    }
}
