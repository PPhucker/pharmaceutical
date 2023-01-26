<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

        event(new Registered($user = $this->create($validated)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return redirect($this->redirectTo)
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
     * @return mixed
     */
    final public function create(array $data)
    {
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]
        );

        $user->giveRolesTo($data['roles']);
        $user->givePermissionsTo($data['permissions']);

        return $user;
    }
}
