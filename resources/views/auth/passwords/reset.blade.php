@extends('layouts.auth')
@section('auth')
    <h1 class="text-primary mb-3">
        {{ __('auth.passwords.reset.action') }}
    </h1>
    <form method="POST"
          action="{{ route('password.update') }}">
        @csrf
        <input type="hidden"
               name="token"
               value="{{ $token }}">
        <div class="mb-3">
            <input id="email"
                   type="email"
                   class="form-control form-control-lg text-primary
                   @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ $email ?? old('email') }}"
                   required>
            @error('email')
            <span class="invalid-feedback"
                  role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="password"
                   type="password"
                   class="form-control form-control-lg text-primary
                     @error('password') is-invalid @enderror"
                   name="password"
                   placeholder="{{ __('auth.passwords.password') }}"
                   required>
            @error('password')
            <span class="invalid-feedback"
                  role="alert">
                <strong>
                    {{ $message }}
                </strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="password-confirm"
                   type="password"
                   class="form-control form-control-lg text-primary"
                   name="password_confirmation"
                   placeholder="{{ __('auth.passwords.confirm.action') }}"
                   required>
        </div>
        <div class="mb-0">
            <button type="submit"
                    class="btn btn-primary">
                {{ __('auth.passwords.reset.button') }}
            </button>
        </div>
    </form>
@endsection
