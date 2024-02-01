<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Auth\User;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер пользователя.
 */
class UserController extends CoreController
{
    protected $prefixLocalKey = 'users';

    /**
     * @var UserService
     */
    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Returns the user list page.
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            'admin.users.index',
            $this->service->getIndexData()
        );
    }

    /**
     * Returns the user edit page.
     *
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user): View
    {
        return view(
            'admin.users.edit',
            $this->service->getEditData($user)
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
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $updatedUser = $this->service->update($user, $request->validated());

        return $this->successRedirect(
            'update',
            ['name' => $updatedUser->name]
        );
    }

    /**
     * Destroy user.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->service->delete($user);

        return $this->successRedirect(
            'delete',
            ['name' => $user->name]
        );
    }

    /**
     * Restore user.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function restore(User $user): RedirectResponse
    {
        $this->service->restore($user);

        return $this->successRedirect(
            'restore',
            ['name' => $user->name]
        );
    }
}
