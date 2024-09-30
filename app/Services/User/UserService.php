<?php

namespace App\Services\User;

use App\Services\Admin\Organization\OrganizationServiceDependencies;
use App\Services\Auth\UserServiceDependencies;
use App\Services\ResourceService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис пользователя.
 */
class UserService extends ResourceService
{
    use SoftDeletesTrait;

    /**
     * @param UserServiceDependencies         $userServiceDependencies
     * @param OrganizationServiceDependencies $organizationServiceDependencies
     */
    public function __construct(
        UserServiceDependencies $userServiceDependencies,
        OrganizationServiceDependencies $organizationServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies([
            $userServiceDependencies,
            $organizationServiceDependencies
        ]);

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->user;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $users = $this->repositories->user->getAll(true);

        return compact('users');
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function getEditData($model): array
    {
        $user = $this->repositories->user->getForEdit($model->id);
        $roles = $this->repositories->role->getAll();
        $permissions = $this->repositories->permission->getAll();
        $organizations = $this->repositories->organization->getAll();

        return compact(
            'user',
            'roles',
            'permissions',
            'organizations'
        );
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        return [];
    }
}
