<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Str;

class ModelHelper
{
    /**
     * Возвращает измененные атрибуты модели.
     *
     * @param mixed $model
     *
     * @return array
     */
    public static function getDirtyAttributes($model): array
    {
        return collect($model->getDirty())
            ->map(function ($value, $attribute) use ($model) {
                return [
                    'before' => $model->getOriginal($attribute),
                    'after' => $value
                ];
            })
            ->toArray();
    }

    /**
     * @return array
     */
    public static function getModelsWithComments(): array
    {
        $modelsWithComments = [];

        foreach (static::all() as $model) {
            $comment = __(
                'models.' . Str::replace('\\', '.', $model)
            );

            $modelsWithComments[] = [
                'class' => $model,
                'comment' => $comment,
            ];
        }

        usort($modelsWithComments, static function ($a, $b) {
            return strcmp($a['comment'], $b['comment']);
        });

        return $modelsWithComments;
    }

    /**
     * Возвращает все объявленные модели.
     *
     * @return Collection
     */
    public static function all(): Collection
    {
        return collect(get_declared_classes())
            ->filter(function ($item) {
                return strncmp($item, 'App\Models\\', 11) === 0;
            });
    }

    /**
     * @param $model
     *
     * @return string
     */
    protected static function getModelName($model): string
    {
        return class_basename($model);
    }
}
