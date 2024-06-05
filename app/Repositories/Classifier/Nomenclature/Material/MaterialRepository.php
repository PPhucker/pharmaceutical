<?php

namespace App\Repositories\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Material\Material;
use App\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий комплектующих.
 */
class MaterialRepository extends ResourceRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $materials = $this->clone()
            ->orderBy('type_id')
            ->orderBy('name');

        if ($withTrashed) {
            $materials->withTrashed();
        }

        return $materials->with('type:id,name')
            ->with('okei:code,symbol')
            ->get();
    }

    /**
     * @param array $notIn
     *
     * @return Collection
     */
    public function getFree(array $notIn): Collection
    {
        return $this->clone()
            ->withoutTrashed()
            ->whereNotIn('id', $notIn)
            ->get();
    }

    /**
     * @param float $nds
     * @param array $invoiceProducts
     *
     * @return Collection
     */
    public function getMaterialCatalog(float $nds = 0, array $invoiceProducts = []): Collection
    {
        return $this->clone()
            ->select(
                [
                    'id',
                    'name',
                    'price',
                    'nds',
                ]
            )
            ->nds($nds)
            ->without($invoiceProducts)
            ->orderBy('type_id')
            ->orderBy('name')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return Material
     */
    public function create(array $validated): Material
    {
        return $this->model->create(
            $this->getFilled($validated)
        );
    }

    /**
     * @param array $validated
     *
     * @return array
     */
    protected function getFilled(array $validated): array
    {
        return [
            'type_id' => (int)$validated['type_id'],
            'okei_code' => (int)$validated['okei_code'],
            'name' => $validated['name'],
            'nds' => (int)$validated['nds'] / 100,
            'price' => (float)$validated['price'],
        ];
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        $model->fill(
            $this->getFilled($validated)
        )
            ->save();
    }

    /**
     * @param int $id
     *
     * @return Material
     */
    public function getForEdit(int $id): Material
    {
        return $this->model->findOrFail($id)
            ->load(
                [
                    'type:id,name',
                    'okei:code,symbol',
                ]
            );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Material::class;
    }
}
