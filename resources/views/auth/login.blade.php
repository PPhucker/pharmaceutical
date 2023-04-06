@extends('layouts.auth')
@section('auth')
    <h1 class="text-primary mb-3">
        {{__('auth.login.action')}}
    </h1>
    <form method="POST"
          action="{{ route('login') }}">
        {{csrf_field()}}
        <div class="mb-3">
            <input id="email"
                   type="email"
                   class="form-control form-control-lg text-primary
                   @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email"
                   placeholder="E-mail"
                   autofocus>
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
                   required
                   placeholder="{{__('auth.passwords.password')}}"
                   autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback"
                  role="alert">
                <strong>
                    {{ $message }}
                </strong>
            </span>
            @enderror
        </div>
        <button type="submit"
                class="btn btn-lg btn-primary">
            {{__('auth.login.button')}}
        </button>
        @if (Route::has('password.request'))
            <a class="btn btn-lg btn-link text-primary"
               role="button"
               href="{{ route('password.request') }}">
                {{ __('auth.passwords.forgot') }}
            </a>
        @endif
    </form>
@endsection
