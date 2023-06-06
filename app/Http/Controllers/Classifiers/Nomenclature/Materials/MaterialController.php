<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Materials;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Materials\StoreMaterialRequest;
use App\Http\Requests\Classifiers\Nomenclature\Materials\UpdateMaterialRequest;
use App\Models\Classifiers\Nomenclature\Materials\Material;
use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\Classifiers\Nomenclature\Materials\TypeOfMaterialRepository;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MaterialController extends CoreController
{
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

        return view(
            'classifiers.nomenclature.materials.index',
            compact('materials')
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
        $validated = $request->validated();

        $material = Material::create(
            [
                'type_id' => $validated['type_id'],
                'okei_code' => $validated['okei_code'],
                'name' => $validated['name'],
                'price' => (float)$validated['price'],
                'nds' => (float)((int)$validated['nds'] / 100),
            ]
        );

        return redirect()
            ->route('materials.index')
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.create.success',
                    ['name' => $material->name]
                )
            );
    }

    /**
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create()
    {
        $okeiClassifier = (new OKEIRepository())->getAll();
        $typesOfMaterials = (new TypeOfMaterialRepository())->getAll();

        return view(
            'classifiers.nomenclature.materials.create',
            compact('okeiClassifier', 'typesOfMaterials')
        );
    }

    /**
     * @param Material $material
     *
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Material $material)
    {
        $material = $this->repository->getById($material->id);
        $okeiClassifier = (new OKEIRepository())->getAll();
        $typesOfMaterials = (new TypeOfMaterialRepository())->getAll();

        return view(
            'classifiers.nomenclature.materials.edit',
            compact('material', 'okeiClassifier', 'typesOfMaterials')
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
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $validated = $request->validated();

        $material->fill(
            [
                'type_id' => $validated['type_id'],
                'okei_code' => $validated['okei_code'],
                'name' => $validated['name'],
                'price' => (float)$validated['price'],
                'nds' => (float)((int)$validated['nds'] / 100),
            ]
        )
            ->save();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.actions.update.success',
                    ['name' => $material->name]
                )
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
}
