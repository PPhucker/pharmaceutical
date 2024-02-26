<?php

namespace App\Repositories\Auth;

use App\Models\Auth\User;
use App\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий пользователя.
 */
class UserRepository extends ResourceRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $users = $this
            ->clone()
            ->select(
                [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
            );

        if ($withTrashed) {
            $users->withTrashed();
        }

        return $users->get();
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function getForEdit(int $id): User
    {
        return $this->clone()
            ->findOrFail($id)
            ->load('roles', 'permissions');
    }

    /**
     * @inheritDoc
     */
    public function create(array $validated): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function update($model, array $validated): User
    {
        $roles = $validated['roles'] ?? null;
        $permissions = $validated['permissions'] ?? null;

        $model->fill(
            $this->getFilled($validated)
        )
            ->refreshRoles($roles)
            ->refreshPermissions($permissions)
            ->save();

        return $model;
    }

    /**
     * @param array $validated
     *
     * @return array
     */
    protected function getFilled(array $validated): array
    {
        return [
            'name' => $validated['name'],
            'email' => $validated['email']
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return User::class;
    }
}
