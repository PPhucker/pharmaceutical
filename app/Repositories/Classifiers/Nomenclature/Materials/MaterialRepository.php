<?php

namespace App\Repositories\Classifiers\Nomenclature\Materials;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Nomenclature\Materials\Material as Model;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

use function Symfony\Component\String\s;

class MaterialRepository extends CoreRepository
{

    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(bool $withTrashed = true)
    {
        $materials = $this->clone()
            ->orderBy('type_id')
            ->orderBy('name');

        if ($withTrashed) {
            $materials->withTrashed();
        } else {
            $materials->withoutTrashed();
        }
        return $materials->with('type:id,name')
            ->with('okei:code,symbol')
            ->get();
    }

    /**
     * @return Collection
     */
    public function getForEndProduct()
    {
        return $this->clone()
            ->orderBy('type_id')
            ->orderBy('name')
            ->with('type:id,name')
            ->with('okei:code,symbol')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getById(int $id)
    {
        $material = $this->clone()->find($id);

        $material->load(
            [
                'type',
                'okei',
            ]
        );

        return $material;
    }

    /**
     * @param float $nds
     * @param array $invoiceProducts
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMaterialCatalog(float $nds = 0, array $invoiceProducts = [])
    {
        $catalog = $this->clone()
            ->select(
                [
                    'classifier_materials.id',
                    'classifier_materials.name',
                    'classifier_materials.price',
                    'classifier_materials.nds',
                ]
            );

        if ($nds) {
            $catalog->where('classifier_materials.nds', '=', $nds);
        }

        if ($invoiceProducts) {
            $catalog->whereNotIn('classifier_materials.id', $invoiceProducts);
        }

        return $catalog
            ->orderBy('type_id')
            ->orderBy('name')
            ->get();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
