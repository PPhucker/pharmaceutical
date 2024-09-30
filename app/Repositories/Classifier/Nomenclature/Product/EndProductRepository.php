<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий конечной продукции.
 */
class EndProductRepository extends ResourceRepository
{
    /**
     * @param int $id
     *
     * @return EndProduct
     */
    public function getForEdit(int $id): EndProduct
    {
        return $this->model->findOrFail($id)
            ->load(
                [
                    'user' => static function ($query) {
                        $query->select(['id', 'name'])
                            ->orderBy('name');
                    },
                    'type' => static function ($query) {
                        $query->select(['id', 'name', 'color',])
                            ->orderBy('name');
                    },
                    'internationalName' => static function ($query) {
                        $query->select(['id', 'name'])
                            ->orderBy('name');
                    },
                    'registrationNumber' => static function ($query) {
                        $query->select(['id', 'number'])
                            ->orderBy('number');
                    },
                    'okei' => static function ($query) {
                        $query->select(['code', 'symbol', 'unit'])
                            ->orderBy('unit');
                    },
                    'okpd2' => static function ($query) {
                        $query->select(['code', 'name'])
                            ->orderBy('name');
                    },
                ]
            );
    }

    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = true): Collection
    {
        $endProducts = $this->clone()
            ->select(
                [
                    'id',
                    'type_id',
                    'full_name',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ]
            );

        if ($withTrashed) {
            $endProducts->withTrashed();
        } else {
            $endProducts->withoutTrashed();
        }

        return $endProducts->with('type:id,color,name')
            ->withTrashed()
            ->orderBy('full_name')
            ->orderBy('type_id')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return EndProduct
     */
    public function create(array $validated): EndProduct
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
            'user_id' => Auth::user()->id,
            'type_id' => (int)$validated['type_id'],
            'international_name_id' => (int)$validated['international_name_id'],
            'registration_number_id' => $validated['registration_number_id']
                ? (int)$validated['registration_number_id']
                : null,
            'okei_code' => $validated['okei_code'],
            'okpd2_code' => $validated['okpd2_code'],
            'short_name' => $validated['short_name'],
            'full_name' => $validated['full_name'],
            'marking' => (bool)$validated['marking'],
            'best_before_date' => (int)$validated['best_before_date'],
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
     * @return string
     */
    protected function getModelClass(): string
    {
        return EndProduct::class;
    }
}
