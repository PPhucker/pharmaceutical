<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

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

    /**
     * Returns all declared models.
     *
     * @return Collection
     */
    public static function all()
    {
        return collect(get_declared_classes())
            ->filter(function ($item) {
                return (
                    strpos(
                        $item,
                        'App\Models\\'
                    ) === 0
                );
            });
    }
}
