<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository;
use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Products\EndProduct as Model;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EndProductRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return $this->clone()
            ->select(
                [
                    'classifier_end_products.id',
                    'classifier_end_products.full_name',
                    'classifier_end_products.created_at',
                    'classifier_end_products.updated_at',
                    'classifier_end_products.deleted_at'
                ]
            )
            ->withTrashed()
            ->orderBy('classifier_end_products.full_name')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getForEdit(int $id)
    {
        $endProduct = $this->model::find($id);

        $endProduct->load(
            [
                'user' => static function ($query) {
                    $query->select(['id', 'name'])
                        ->orderBy('name');
                },
                'type' => static function ($query) {
                    $query->select(['id', 'name'])
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
                    $query->select(['code', 'symbol'])
                        ->orderBy('symbol');
                },
                'okpd2' => static function ($query) {
                    $query->select(['code', 'name'])
                        ->orderBy('name');
                },
                'materials' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'type_id',
                            'okei_code',
                            'name'
                        ]
                    )
                        ->orderBy('type_id')
                        ->orderBy('name')
                        ->with('okei:code,symbol')
                        ->get();
                },
                'aggregationTypes' => static function ($query) {
                    $query->select(
                        [
                            'code',
                            'name',
                        ]
                    )
                        ->orderBy('code');
                },
            ]
        );

        $classifiers = $this->getClassifiers();

        return collect(
            [
                'end_product' => $endProduct,
                'types' => $classifiers['types'],
                'international_names' => $classifiers['international_names'],
                'registration_numbers' => $classifiers['registration_numbers'],
                'okei' => $classifiers['okei'],
                'okpd2' => $classifiers['okpd2'],
                'materials' => $classifiers['materials'],
                'aggregation_types' => $classifiers['aggregation_types'],
            ]
        );
    }

    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getClassifiers()
    {
        $types = (new TypeOfEndProductRepository())
            ->getAll();
        $internationalNames = (new InternationalNameOfEndProductRepository())
            ->getAll();
        $registrationNumbers = (new RegistrationNumberOfEndProductRepository())
            ->getAll();
        $okei = (new OKEIRepository())
            ->getAll();
        $okpd2 = (new OKPD2Repository())
            ->getAll();
        $materials = (new MaterialRepository())
            ->getForEndProduct();
        $aggregationTypes = (new TypeOfAggregationRepository())
            ->getAll();

        return collect(
            [
                'types' => $types,
                'international_names' => $internationalNames,
                'registration_numbers' => $registrationNumbers,
                'okei' => $okei,
                'okpd2' => $okpd2,
                'materials' => $materials,
                'aggregation_types' => $aggregationTypes
            ]
        );
    }
}
