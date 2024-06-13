<?php

namespace App\Traits\Auth\Relation;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use function is_array;

/**
 * Трейт ролей и прав пользователя.
 */
trait HasRolesAndPermissions
{
    /**
     * User has a role.
     *
     * @param $roles
     *
     * @return bool
     */
    public function hasRole($roles): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $roles = is_array($roles) ? $roles : [$roles];

        return (bool)array_filter($roles, function ($role) {
            return $this->roles->contains('slug', $role);
        });
    }

    /**
     * User is Administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->roles->contains('slug', 'admin');
    }

    /**
     * Refresh user permissions.
     *
     * @param $permissions
     *
     * @return $this
     */
    public function refreshPermissions($permissions): self
    {
        $this->permissions()->detach();
        return $permissions ? $this->givePermissionsTo($permissions) : $this;
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions')
            ->withTimestamps();
    }

    /**
     * Сохранение прав для текущего пользователя.
     *
     * @param $permissions
     *
     * @return $this
     */
    public function givePermissionsTo($permissions): self
    {
        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Get all permissions.
     *
     * @param $permissions
     *
     * @return Collection
     */
    public function getAllPermissions($permissions): Collection
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
     * Refresh user roles.
     *
     * @param $roles
     *
     * @return $this
     */
    public function refreshRoles($roles): self
    {
        $this->roles()->detach();
        return $roles ? $this->giveRolesTo($roles) : $this;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles')
            ->withTimestamps();
    }

    /**
     * @param $roles
     *
     * @return $this
     */
    public function giveRolesTo($roles): self
    {
        $this->roles()->saveMany($this->getAllRoles($roles));
        return $this;
    }

    /**
     * Get all roles.
     *
     * @param $roles
     *
     * @return Collection
     */
    public function getAllRoles($roles): Collection
    {
        return Role::whereIn('slug', $roles)->get();
    }

    /**
     * @return bool
     */
    public function canDelete(): bool
    {
        return $this->hasPermission(['deleting']);
    }

    /**
     * User has a permission.
     *
     * @param $permissions
     *
     * @return bool
     */
    public function hasPermission($permissions): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $permissions = is_array($permissions) ? $permissions : [$permissions];

        return (bool)array_filter($permissions, function ($permission) {
            return $this->permissions->contains('slug', $permission);
        });
    }

    /**
     * @return bool
     */
    public function canRestore(): bool
    {
        return $this->hasPermission(['restoring']);
    }
}
