<?php

namespace App\Traits\Model;

use ReflectionClass;
use ReflectionException;

use function in_array;

/**
 * Трейт для получения всех зависимостей модели.
 */
trait RelationshipsTrait
{
    /**
     * Типы зависимостей.
     *
     * @var array
     */
    private $relationTypes = [
        'HasOne',
        'HasMany',
        'BelongsTo',
        'BelongsToMany',
        'MorphToMany',
        'MorphTo'
    ];

    /**
     * Возвращает отношения модели.
     *
     * @param array|null $types ['HasOne', 'HasMany', 'BelongsTo', 'BelongsToMany', 'MorphToMany', 'MorphTo']
     *
     * @return array
     * @throws ReflectionException
     */
    public function relationships(?array $types = null): array
    {
        $model = new static();

        $reflector = new ReflectionClass($model);
        $relations = [];

        foreach ($reflector->getMethods() as $reflectionMethod) {
            $returnType = $reflectionMethod->getReturnType();

            $methods = $types
                ?: $this->relationTypes;

            if (
                $returnType
                && in_array(
                    class_basename($returnType->getName()),
                    $methods,
                    true
                )
            ) {
                $relations[] = $reflectionMethod->getShortName();
            }
        }

        return $relations;
    }
}
