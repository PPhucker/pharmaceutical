<?php

namespace App\Repositories\Admin\Organization;

use App\Models\Admin\Organization\Staff;
use App\Repositories\CrudRepository;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для сотрудника организции.
 */
class StaffRepository extends CrudRepository
{
    use SoftDeletesTrait;

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()->all();
    }

    /**
     * @param array $validated
     *
     * @return Staff
     */
    public function create(array $validated): Staff
    {
        return $this->model->create(
            [
                'organization_id' => $validated['organization_id'],
                'organization_place_of_business_id' =>
                    $validated['organization_place_of_business_id'],
                'name' => $validated['name'],
                'post' => $validated['post'],
            ]
        );
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        foreach ($validated as $staff) {
            $model->find((int)$staff['id'])
                ->fill(
                    [
                        'organization_place_of_business_id' =>
                            $staff['organization_place_of_business_id'],
                        'name' => $staff['name'],
                        'post' => $staff['post'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Staff::class;
    }
}
