<?php

namespace App\Repositories\Contractors;

use App\Models\Contractors\ContactPerson;
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
        return ContactPerson::create(
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
            ContactPerson::withTrashed()
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
