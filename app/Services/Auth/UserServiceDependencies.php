<?php

namespace App\Services\Auth;

use App\Repositories\Auth\PermissionRepository;
use App\Repositories\Auth\RoleRepository;
use App\Repositories\Auth\UserRepository;
use App\Services\Contractor\CoreDependencyService;

/**
 * Сервис зависимостей для UserService.
 */
class UserServiceDependencies extends CoreDependencyService
{
    /**
     * @param UserRepository       $user
     * @param RoleRepository       $role
     * @param PermissionRepository $permission
     */
    public function __construct(
        UserRepository $user,
        RoleRepository $role,
        PermissionRepository $permission
    ) {
        $this->repositories = compact(
            'user',
            'role',
            'permission'
        );
    }
}
