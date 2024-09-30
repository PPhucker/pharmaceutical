<?php

namespace App\Repositories\Auth;

use App\Models\Auth\Permission;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий прав пользователя.
 */
class PermissionRepository extends CoreRepository
{
    private const ABSOLUTE_PERMISSIONS = [
        'all',
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
     * @param array $permissions
     *
     * @return Collection
     */
    public function getUsersByPermissions(array $permissions): Collection
    {
        return $this->clone()
            ->whereIn(
                'slug',
                array_merge(self::ABSOLUTE_PERMISSIONS, $permissions)
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
        return Permission::class;
    }
}
