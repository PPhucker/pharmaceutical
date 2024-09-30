<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Класс помощник для работы с моделями.
 */
class ModelHelper
{
    private const DIRTY_IGNORED_FIELDS = [
        'deleted_at',
        'remember_token',
    ];

    /**
     * Возвращает измененные атрибуты модели.
     *
     * @param Model $model
     * @return array
     */
    public static function getDirtyAttributes(Model $model): array
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
     * Возвращает модели с комментариями.
     *
     * @return array
     */
    public static function getModelsWithComments(): array
    {
        $modelsWithComments = static::all()->map(function ($model) {
            return [
                'class' => $model,
                'comment' => __(
                    'models.' . Str::replace('\\', '.', $model)
                ),
            ];
        })->sortBy('comment')->values()->toArray();

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
            ->filter(function ($class) {
                return str_starts_with($class, 'App\Models\\');
            })
            ->values();
    }

    /**
     * Проверяет, есть ли изменения в модели, не учитывая игнорируемые поля.
     *
     * @param Model $model
     * @return bool
     */
    public static function modelIsDirty($model): bool
    {
        $dirty = array_diff_key($model->getDirty(), array_flip(self::DIRTY_IGNORED_FIELDS));

        return !empty($dirty);
    }
}
