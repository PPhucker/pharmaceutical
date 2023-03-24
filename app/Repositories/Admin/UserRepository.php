<?php

namespace App\Repositories\Admin;

use App\Models\Auth\Permission;
use App\Repositories\CoreRepository;
use App\Models\Auth\User as Model;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends CoreRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     */
    public function getAll()
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
     * @param int $id
     *
     * @return Model
     */
    public function getForEdit(int $id)
    {
        return $this->clone()
            ->find($id)
            ->load('roles', 'permissions');
    }

    /**
     * @return Collection
     */
    public function getForEmailCreatedContractorNotification()
    {
        $permissions = Permission::whereIn('slug', ['all', 'verification_contractors'])
            ->first();

        return $permissions->usersForEmailNotification()
            ->get();

    }
}
