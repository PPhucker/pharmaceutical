<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Logging\Logger;
use App\Models\Admin\Organization\Organization;
use App\Models\Auth\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Контроллер авторизации.
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string $redirectTo
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')
            ->except('logout');
    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse|RedirectResponse|Response
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $validated = $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            (new Logger())->userActionNotice(
                'login',
                Auth::user()
            );

            event(new UserLoggedIn((int)$validated['organization']));

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        (new Logger())->userActionNotice(
            'login_failed',
            Auth::user(),
            [
                'email' => $request->input('email'),
            ]
        );

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return array
     * @throws ValidationException
     */
    public function validateLogin(LoginRequest $request): array
    {
        $validated = $request->validated();

        $organizationId = (int)$validated['organization'];

        $user = User::where('email', $validated['email'])->first();

        if (!$user->hasOrganization([$organizationId])) {
            throw ValidationException::withMessages([
                'organization' => [__('auth.organization_failed')],
            ]);
        }

        return $validated;
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        $organizations = Organization::select([
            'id',
            'legal_form_type',
            'name',
            'INN'
        ])
            ->with(['legalForm:abbreviation'])
            ->get()
            ->sortBy('full_name');

        return view('auth.login', compact('organizations'));
    }
}
