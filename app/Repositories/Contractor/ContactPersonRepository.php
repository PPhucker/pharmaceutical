<?php

namespace App\Repositories\Contractor;

use App\Models\Contractor\ContactPerson;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий контактного лица контрагента.
 */
class ContactPersonRepository extends CrudRepository
{
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
     * @return ContactPerson
     */
    public function create(array $validated): ContactPerson
    {
        return $this->model->create(
            [
                'contractor_id' => $validated['contractor_id'],
                'name' => $validated['name'],
                'post' => $validated['post'],
                'phone' => $validated['phone'],
                'email' => $validated['email']
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
        foreach ($validated as $person) {
            $this->model
                ->withTrashed()
                ->findOrFail((int)$person['id'])
                ->fill(
                    [
                        'name' => $person['name'],
                        'post' => $person['post'],
                        'phone' => $person['phone'],
                        'email' => $person['email']
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
        return ContactPerson::class;
    }
}
