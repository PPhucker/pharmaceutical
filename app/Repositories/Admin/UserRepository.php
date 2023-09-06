<?php

namespace App\Repositories\Admin;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Repositories\CoreRepository;
use App\Models\Auth\User as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий пользователя.
 */
class UserRepository extends CoreRepository
{

    /**
     * Все пользователи.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this
            ->clone()
            ->select(
                [
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.email_verified_at',
                    'users.created_at',
                    'users.updated_at',
                    'users.deleted_at'
                ]
            )
            ->withTrashed()
            ->get();
    }

    /**
     * Пользователь по ID.
     *
     * @param int $id
     *
     * @return User
     */
    public function getForEdit(int $id): User
    {
        return $this->clone()
            ->find($id)
            ->load('roles', 'permissions');
    }

    /**
     * Пользователи для e-mail рассылки после заведения нового контрагента.
     *
     * @return Collection
     */
    public function getForEmailCreatedContractorNotification(): Collection
    {
        $permissions = Permission::whereIn('slug', ['all', 'verification_contractors'])
            ->first();

        return $permissions->usersForEmailNotification()
            ->get();
    }

    /**
     * Пользователи с ролью 'marketing'.
     *
     * @return Collection
     */
    public function getMarketingUsers(): Collection
    {
        $role = Role::whereIn('slug', ['admin', 'marketing'])
            ->first();

        return $role->usersForEmailNotification()
            ->get();
    }

    /**
     * Пользователи для e-mail рассылки после создания комплекта документов на отгрузку.
     *
     * @return Collection
     */
    public function getForCreatedShipmentNotification(): Collection
    {
        $permissions = Permission::whereIn('slug', ['all', 'approve_shipment_documents'])
            ->first();

        return $permissions->usersForEmailNotification()
            ->get();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
