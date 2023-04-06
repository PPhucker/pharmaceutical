<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    final public function showRegistrationForm()
    {
        return view(
            'auth.register',
            [
                'roles' => Role::all(),
                'permissions' => Permission::all()
            ]
        );
    }

    final public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = $this->create($validated);

        event(new Registered($user));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return back()
            ->with(
                'success',
                __('users.action.register.success', ['name' => $user->name])
            );
    }

    /**
     * Create a new user.
     *
     * @param array $data
     *
     * @return Model|User
     */
    final public function create(array $data)
    {
        $roles = $data['roles'] ?? null;
        $permissions = $data['permissions'] ?? null;

        return User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]
        )
            ->refreshRoles($roles)
            ->refreshPermissions($permissions);
    }
}
