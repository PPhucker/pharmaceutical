<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Material;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Material\StoreMaterialRequest;
use App\Http\Requests\Classifier\Nomenclature\Material\UpdateMaterialRequest;
use App\Models\Classifier\Nomenclature\Material\Material;
use App\Services\Classifier\Nomenclature\Material\MaterialService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер комплектующего.
 */
class MaterialController extends CoreController
{
    private const VIEW_PREFIX = 'classifiers.nomenclature.materials.';

    /**
     * @var MaterialService
     */
    private $service;

    /**
     * @param MaterialService $service
     */
    public function __construct(MaterialService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Material::class, 'material');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            self::VIEW_PREFIX . 'index',
            $this->service->getIndexData()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMaterialRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()
        );

        return $this->successRedirect('materials.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view(
            self::VIEW_PREFIX . 'create',
            $this->service->getCreateData()
        );
    }

    /**
     * @param Material $material
     *
     * @return View
     */
    public function edit(Material $material): View
    {
        return view(
            self::VIEW_PREFIX . 'edit',
            $this->service->getEditData($material)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMaterialRequest $request
     * @param Material              $material
     *
     * @return RedirectResponse
     */
    public function update(UpdateMaterialRequest $request, Material $material): RedirectResponse
    {
        $this->service->update(
            $material,
            $request->validated()
        );

        return $this->successRedirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Material $material
     *
     * @return RedirectResponse
     */
    public function destroy(Material $material): RedirectResponse
    {
        $this->service->delete($material);

        return $this->successRedirect();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Material $material
     *
     * @return RedirectResponse
     */
    public function restore(Material $material): RedirectResponse
    {
        $this->service->restore($material);

        return $this->successRedirect();
    }
}
