<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Materials;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Materials\StoreMaterialRequest;
use App\Http\Requests\Classifiers\Nomenclature\Materials\UpdateMaterialRequest;
use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\Classifiers\Nomenclature\Materials\TypeOfMaterialRepository;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MaterialController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Material::class, 'material');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return MaterialRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index()
    {
        $materials = $this->repository->getAll();
        $typesOfMaterials = (new TypeOfMaterialRepository())->getAll();
        $okei = (new OKEIRepository())->getAll();

        return view(
            'classifiers.nomenclature.materials.index',
            compact('materials', 'typesOfMaterials', 'okei')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMaterialRequest $request)
    {
        $validated = $request->validated()['material'];

        $material = Material::create(
            [
                'type_id' => $validated['type_id'],
                'okei_code' => $validated['okei_code'],
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.create.success',
                    ['name' => $material->name]
                )
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMaterialRequest $request
     * @param Material|null         $material
     *
     * @return RedirectResponse
     */
    public function update(UpdateMaterialRequest $request, Material $material = null)
    {
        $validated = $request->validated();

        foreach ($validated['materials'] as $item) {
            Material::find((int)$item['id'])
                ->fill(
                    [
                        'type_id' => $item['type_id'],
                        'okei_code' => $item['okei_code'],
                        'name' => $item['name'],
                    ]
                )
                ->save();
        }
        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.materials.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Material $material
     *
     * @return RedirectResponse
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.delete.success',
                    ['name' => $material->name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Material $material
     *
     * @return RedirectResponse
     */
    public function restore(Material $material)
    {
        $material->restore();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.restore.success',
                    ['name' => $material->name]
                )
            );
    }
}
