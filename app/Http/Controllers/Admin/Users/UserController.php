<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Repositories\Admin\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return UserRepository::class;
    }

    /**
     * Returns the user list page.
     *
     * @return View
     */
    public function index()
    {
        $users = $this->repository->getAll();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Returns the user edit page.
     *
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user)
    {
        $user = $this->repository->getForEdit($user->id);
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        return view(
            'admin.users.edit',
            compact(
                'user',
                'roles',
                'permissions'
            )
        );
    }

    /**
     * Update user.
     *
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $roles = $validated['roles'] ?? null;
        $permissions = $validated['permissions'] ?? null;

        $user->fill(
            [
                'name' => $validated['name'],
                'email' => $validated['email']
            ]
        )
            ->refreshRoles($roles)
            ->refreshPermissions($permissions)
            ->save();

        return back()
            ->with(
                'success',
                __('users.action.update.success', ['name' => $user->name])
            );
    }

    /**
     * Destroy user.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with(
            'success',
            __('users.action.destroy', ['name' => $user->name])
        );
    }

    /**
     * Restore user.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function restore(User $user)
    {
        $user->restore();

        return back()->with(
            'success',
            __('users.action.restore', ['name' => $user->name])
        );
    }
}
