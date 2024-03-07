<?php

namespace App\Services\User;

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
     * @param UserServiceDependencies $userServiceDependencies
     */
    public function __construct(UserServiceDependencies $userServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $userServiceDependencies,
            ]
        );

        $this->selectedRepo = $this->selectRepository();
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

        return compact(
            'user',
            'roles',
            'permissions'
        );
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        return [];
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->user;
    }
}
