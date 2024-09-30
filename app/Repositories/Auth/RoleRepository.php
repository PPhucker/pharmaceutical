<?php

namespace App\Repositories\Auth;

use App\Models\Auth\Role;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий ролей пользователя.
 */
class RoleRepository extends CoreRepository
{
    private const ABSOLUTE_ROLES = [
        'admin',
    ];

    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('name')
            ->get();
    }

    /**
     * @param array $roles
     *
     * @return Collection
     */
    public function getUsersByRoles(array $roles): Collection
    {
        return $this->clone()
            ->whereIn(
                'slug',
                array_merge(self::ABSOLUTE_ROLES, $roles)
            )
            ->first()
            ->users()
            ->get();
    }

    /**
     * @inheritdoc
     */
    protected function getModelClass(): string
    {
        return Role::class;
    }
}
