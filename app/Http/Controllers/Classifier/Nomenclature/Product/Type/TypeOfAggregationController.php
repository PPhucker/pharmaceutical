<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product\Type;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfAggregation\StoreTypeOfAggregationRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfAggregation\UpdateTypeOfAggregationRequest;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Services\Classifier\Nomenclature\Product\Type\TypeOfAggregationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер типа агрегации.
 */
class TypeOfAggregationController extends CoreController
{
    /**
     * @var TypeOfAggregationService
     */
    private $service;

    /**
     * @param TypeOfAggregationService $service
     */
    public function __construct(TypeOfAggregationService $service)
    {
        $this->service = $service;
        $this->authorizeResource(TypeOfAggregation::class, 'type_of_aggregation');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.types-of-aggregation.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreTypeOfAggregationRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfAggregationRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['type_of_aggregation']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateTypeOfAggregationRequest $request
     * @param TypeOfAggregation              $typeOfAggregation
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateTypeOfAggregationRequest $request,
        TypeOfAggregation $typeOfAggregation
    ): RedirectResponse {
        $this->service->update(
            $typeOfAggregation,
            $request->validated()['types_of_aggregation']
        );

        return $this->successRedirect();
    }
}
