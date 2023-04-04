<?php

namespace App\Traits\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

trait HasRolesAndPermissions
{
    /**
     * User is Administrator.
     *
     * @return bool
     */
    final public function isAdmin()
    {
        return $this->roles->contains('slug', 'admin');
    }

    /**
     * User has a role.
     *
     * @param $roles
     *
     * @return bool
     */
    final public function hasRole($roles): bool
    {
        foreach ($roles as $role) {
            if ($this->isAdmin() || $this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * User has the permission, directly or through a role.
     *
     * @param $permissions
     *
     * @return bool
     */
    final public function hasPermissionTo($permissions): bool
    {
        return $this->hasPermissionThroughRole($permissions) || $this->hasPermission($permissions);
    }

    /**
     * The user has the permission through the role.
     *
     * @param $permissions
     *
     * @return bool
     */
    final public function hasPermissionThroughRole($permissions): bool
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
    final public function hasPermission($permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->isAdmin() || $this->permissions->contains('slug', $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all permissions.
     *
     * @param $permissions
     *
     * @return Builder[]|Collection|HasRolesAndPermissions|\Illuminate\Database\Eloquent\Collection|Permission[]
     */
    final public function getAllPermissions($permissions)
    {
        $permissions = Permission::whereIn('slug', $permissions)->get();

        if (!$permissions) {
            return $this;
        }

        return $permissions;
    }

    final public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Refresh user permissions.
     *
     * @param $permissions
     *
     * @return HasRolesAndPermissions
     */
    final public function refreshPermissions($permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    /**
     * Сохранение прав для текущего пользователя.
     *
     * @param $permissions
     *
     * @return $this
     */
    final public function givePermissionsTo($permissions)
    {
        if ($permissions === null) {
            return $this;
        }

        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Refresh user roles.
     *
     * @param $roles
     *
     * @return HasRolesAndPermissions
     */
    final public function refreshRoles($roles)
    {
        $this->roles()->detach();
        return $this->giveRolesTo($roles);
    }

    final public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    final public function giveRolesTo($roles)
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
     * @return Builder[]|Collection|HasRolesAndPermissions|\Illuminate\Database\Eloquent\Collection|Role[]
     */
    final public function getAllRoles($roles)
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
    public function canDelete()
    {
        return $this->hasPermission(['deleting']);
    }

    /**
     * @return bool
     */
    public function canRestore()
    {
        return $this->hasPermission(['restoring']);
    }
}
