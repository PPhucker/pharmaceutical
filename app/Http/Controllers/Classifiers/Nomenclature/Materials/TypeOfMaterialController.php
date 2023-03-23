<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Materials;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Materials\TypeOfMaterial\StoreTypeOfMaterialRequest;
use App\Http\Requests\Classifiers\Nomenclature\Materials\TypeOfMaterial\UpdateTypeOfMaterialRequest;
use App\Models\Classifiers\Nomenclature\Materials\TypeOfMaterial as Model;
use App\Repositories\Classifiers\Nomenclature\Materials\TypeOfMaterialRepository as Repository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TypeOfMaterialController extends CoreController
{
    protected function getRepository()
    {
        return Repository::class;
    }

    protected function getPolicy()
    {
        $this->authorizeResource(Model::class, 'types_of_material');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $typesOfMaterials = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.materials.types-of-materials.index',
            compact('typesOfMaterials')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeOfMaterialRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfMaterialRequest $request)
    {
        $validated = $request->validated()['type_of_material'];

        $typeOfMaterial = Model::create(
            [
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.materials.types_of_materials.actions.create.success',
                    ['name' => $typeOfMaterial->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeOfMaterialRequest $request
     * @param Model|null                  $types_of_material
     *
     * @return RedirectResponse
     */
    public function update(UpdateTypeOfMaterialRequest $request, Model $types_of_material = null)
    {
        $validated = $request->validated();

        foreach ($validated['types_of_materials'] as $item) {
            $typeOfMaterial = Model::find((int)$item['id']);
            $typeOfMaterial->fill(
                [
                    'name' => $item['name'],
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.materials.types_of_materials.actions.update.success')
            );
    }
}
