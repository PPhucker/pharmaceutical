<?php

namespace App\Traits\Auth\Relation;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        foreach ($roles as $role) {
            if ($this->isAdmin() || $this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * User is Administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles->contains('slug', 'admin');
    }

    /**
     * User has the permission, directly or through a role.
     *
     * @param $permissions
     *
     * @return bool
     */
    public function hasPermissionTo($permissions): bool
    {
        return $this->hasPermissionThroughRole($permissions)
            || $this->hasPermission($permissions);
    }

    /**
     * The user has the permission through the role.
     *
     * @param $permissions
     *
     * @return bool
     */
    public function hasPermissionThroughRole($permissions): bool
    {
        foreach ($permissions as $permission) {
            foreach (Permission::where('slug', $permission)->roles as $role) {
                if ($this->roles->contains($role)) {
                    return true;
                }
            }
        }
        return false;
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
        foreach ($permissions as $permission) {
            if ($this->isAdmin() || $this->permissions->contains('slug', $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Refresh user permissions.
     *
     * @param $permissions
     *
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions($permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Сохранение прав для текущего пользователя.
     *
     * @param $permissions
     *
     * @return $this
     */
    public function givePermissionsTo($permissions)
    {
        if ($permissions === null) {
            return $this;
        }

        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Get all permissions.
     *
     * @param $permissions
     *
     * @return HasRolesAndPermissions|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions($permissions)
    {
        $permissions = Permission::whereIn('slug', $permissions)->get();

        if (!$permissions) {
            return $this;
        }

        return $permissions;
    }

    /**
     * Refresh user roles.
     *
     * @param $roles
     *
     * @return HasRolesAndPermissions
     */
    public function refreshRoles($roles)
    {
        $this->roles()->detach();
        return $this->giveRolesTo($roles);
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * @param $roles
     *
     * @return $this
     */
    public function giveRolesTo($roles)
    {
        if ($roles === null) {
            return $this;
        }

        $roles = $this->getAllRoles($roles);
        $this->roles()->saveMany($roles);
        return $this;
    }

    /**
     * Get all roles.
     *
     * @param $roles
     *
     * @return HasRolesAndPermissions|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles($roles)
    {
        $roles = Role::whereIn('slug', $roles)->get();

        if (!$roles) {
            return $this;
        }

        return $roles;
    }

    /**
     * @return bool
     */
    public function canDelete(): bool
    {
        return $this->hasPermission(['deleting']);
    }

    /**
     * @return bool
     */
    public function canRestore(): bool
    {
        return $this->hasPermission(['restoring']);
    }
}
