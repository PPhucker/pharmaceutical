<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Repository;

use App\Traits\Repository\BelongsToManyRepositoryTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Трейт для репозитория комплектующих готовой продукции.
 */
trait MaterialRepositoryTrait
{
    use BelongsToManyRepositoryTrait;

    /**
     * @param BelongsToMany $target
     * @param array         $validated
     *
     * @return void
     */
    public function attachMaterial(BelongsToMany $target, array $validated): void
    {
        $options = [
            (int)$validated['id'],
        ];

        $this->attach($target, $options);
    }

    /**
     * @param BelongsToMany $target
     * @param array         $validated
     *
     * @return void
     */
    public function detachMaterial(BelongsToMany $target, array $validated): void
    {
        $options = [
            (int)$validated['id'],
        ];

        $this->detach($target, $options);
    }
}
