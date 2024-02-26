<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfAggregation\StoreTypeOfAggregationRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfAggregation\UpdateTypeOfAggregationRequest;
use App\Models\Classifier\Nomenclature\Product\TypeOfAggregation;
use App\Repositories\Classifier\Nomenclature\Product\Type\TypeOfAggregationRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TypeOfAggregationController extends CoreController
{
    /**
     * @return string
     */
    protected function getRepository()
    {
        return TypeOfAggregationRepository::class;
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(
            TypeOfAggregation::class,
            'types_of_aggregation'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $typesOfAggregation = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.types-of-aggregation.index',
            compact('typesOfAggregation')
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeOfAggregationRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfAggregationRequest $request)
    {
        $validated = $request->validated()['type_of_aggregation'];

        $typeOfAggregation = TypeOfAggregation::create(
            [
                'code' => $validated['code'],
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.types_of_aggregation.actions.create.success',
                    ['name' => $typeOfAggregation->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeOfAggregationRequest $request
     * @param TypeOfAggregation|null         $types_of_aggregation
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateTypeOfAggregationRequest $request,
        TypeOfAggregation $types_of_aggregation = null
    ) {
        $validated = $request->validated();

        foreach ($validated['types_of_aggregation'] as $type) {
            TypeOfAggregation::find($type['original_code'])
                ->fill(
                    [
                        'code' => $type['code'],
                        'name' => $type['name'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.types_of_aggregation.actions.update.success')
            );
    }
}
