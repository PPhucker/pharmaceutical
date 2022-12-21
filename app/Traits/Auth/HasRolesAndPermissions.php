<?php

namespace App\Traits\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;

trait HasRolesAndPermissions
{
    /**
     * User has a role.
     *
     * @param array $roles
     *
     * @return bool
     */
    final public function hasRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * User has the permission, directly or through a role.
     *
     * @param array $permissions
     *
     * @return bool
     */
    final public function hasPermissionTo(array $permissions): bool
    {
        return $this->hasPermissionThroughRole($permissions) || $this->hasPermission($permissions);
    }

    /**
     * The user has the permission through the role.
     *
     * @param array $permissions
     *
     * @return bool
     */
    final public function hasPermissionThroughRole(array $permissions): bool
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
     * @param array $permissions
     *
     * @return bool
     */
    final public function hasPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->permissions->contains('slug', $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Remove user permissions.
     *
     * @param ...$permissions mixed Список прав.
     *
     * @return $this
     */
    final public function deletePermissions(...$permissions): self
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * Get all permissions.
     *
     * @param array $permissions
     *
     * @return mixed
     */
    final public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    final public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Refresh user permissions.
     *
     * @param array $permissions
     *
     * @return HasRolesAndPermissions
     */
    final public function refreshPermissions(array $permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    /**
     * Сохранение прав для текущего пользователя.
     *
     * @param $permissions array Список прав.
     *
     * @return $this
     */
    final public function givePermissionsTo(array $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Refresh user roles.
     *
     * @param array $roles
     *
     * @return HasRolesAndPermissions
     */
    final public function refreshRoles(array $roles)
    {
        $this->roles()->detach();
        return $this->giveRolesTo($roles);
    }

    final public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    final public function giveRolesTo(array $roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);
        return $this;
    }

    /**
     * Get all roles.
     *
     * @param array $roles
     *
     * @return mixed
     */
    final public function getAllRoles(array $roles)
    {
        return Role::whereIn('slug', $roles)->get();
    }
}
