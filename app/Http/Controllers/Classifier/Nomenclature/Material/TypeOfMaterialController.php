<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Material;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Material\TypeOfMaterial\StoreTypeOfMaterialRequest;
use App\Http\Requests\Classifier\Nomenclature\Material\TypeOfMaterial\UpdateTypeOfMaterialRequest;
use App\Models\Classifier\Nomenclature\Material\TypeOfMaterial;
use App\Services\Classifier\Nomenclature\Matireal\TypeOfMaterialService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер типа комплектующих.
 */
class TypeOfMaterialController extends CoreController
{
    /**
     * @var TypeOfMaterialService
     */
    private $service;

    /**
     * @param TypeOfMaterialService $service
     */
    public function __construct(TypeOfMaterialService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.materials.types-of-materials.index',
            $this->service->getIndexData()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeOfMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfMaterialRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['type_of_material']
        );

        return $this->successRedirect();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeOfMaterialRequest $request
     * @param TypeOfMaterial              $typeOfMaterial
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateTypeOfMaterialRequest $request,
        TypeOfMaterial $typeOfMaterial
    ): RedirectResponse {
        $this->service->update(
            $typeOfMaterial,
            $request->validated()['types_of_materials']
        );

        return $this->successRedirect();
    }
}
