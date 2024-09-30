<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog;

use App\Helpers\DateHelper;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Repositories\Admin\Organization\PlaceOfBusinessRepository;
use App\Repositories\Classifier\Nomenclature\Product\Catalog\ProductCatalogRepository;
use App\Repositories\Contractor\ContractorRepository;
use App\Services\Classifier\Nomenclature\Product\Catalog\Price\PriceServiceDependencies;
use App\Services\Classifier\Nomenclature\Product\EndProductServiceDependencies;
use App\Services\Contractor\Address\AddressServiceDependencies;
use App\Services\ResourceService;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Service\AggregationTypeServiceTrait;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Service\MaterialServiceTrait;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Сервис каталога готовой продукции.
 */
class ProductCatalogService extends ResourceService
{
    use SoftDeletesTrait;
    use AggregationTypeServiceTrait;
    use MaterialServiceTrait;

    /**
     * @param EndProductServiceDependencies $endProductServiceDependencies
     * @param AddressServiceDependencies    $addressServiceDependencies
     * @param PriceServiceDependencies      $priceServiceDependencies
     *
     * @throws BindingResolutionException
     */
    public function __construct(
        EndProductServiceDependencies $endProductServiceDependencies,
        AddressServiceDependencies $addressServiceDependencies,
        PriceServiceDependencies $priceServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies([
            $endProductServiceDependencies,
            $addressServiceDependencies,
            $priceServiceDependencies
        ]);

        $this->repositories->placeOfBusiness = app()
            ->make(PlaceOfBusinessRepository::class);

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object|ProductCatalogRepository
     * @throws BindingResolutionException
     */
    protected function selectRepository(): object
    {
        return app()->make(ProductCatalogRepository::class);
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $productsCatalog = $this->selectedRepo->getAll(true);

        return compact('productsCatalog');
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function getEditData($model): array
    {
        return [
            'productCatalog' => $this->selectedRepo->getForEdit($model->id),
            'endProducts' => $this->repositories->endProduct->getAll(),
            'placesOfBusiness' => $this->repositories->placeOfBusiness->getAll(),
            'typesOfAggregation' => $this->repositories->typeOfAggregation->getAll(),
            'regions' => $this->repositories->region->getAll(),
            'materials' => $this->repositories->material->getFree(
                $this->selectedRepo->getMaterialsId($model->id)
            ),
        ];
    }

    /**
     * @param array          $validated
     * @param ProductCatalog $productCatalog
     *
     * @return array
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getSalesStatisticsByContractorData(array $validated, ProductCatalog $productCatalog): array
    {
        $dateRange = DateHelper::getDateRange($validated);

        $contractorRepo = app()->make(ContractorRepository::class);

        $contractors = $contractorRepo->productCatalogSaleStatistic(
            $productCatalog->id,
            $dateRange->toArray()
        );

        return compact('contractors', 'productCatalog', 'dateRange');
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        $endProducts = $this->repositories->endProduct->getAll();
        $placesOfBusiness = $this->repositories->placeOfBusiness->getAll();

        return compact('endProducts', 'placesOfBusiness');
    }
}
