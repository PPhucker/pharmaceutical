@extends('layouts.auth')
@section('auth')
    <h1 class="text-primary mb-3 text-center">
        {{__('auth.login.action')}}
    </h1>
    <form method="POST"
          action="{{ route('login') }}">
        {{ csrf_field() }}
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
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
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
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            @error('organization')
            <strong class="text-danger">
                {{ $message }}
            </strong>
            @enderror
        </div>
        @foreach ($organizations as $organization)
            <div class="mb-2">
                <div class="row text-primary">
                    <div class="col-6 text-nowrap">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="organization"
                                   id="organization{{ $organization->id }}"
                                   value="{{ $organization->id }}"
                                   required>
                            <label class="form-check-label"
                                   for="organization{{ $organization->id }}">
                                {{ $organization->full_name }}
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        {{$organization->INN}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-2">
            <div class="row">
                <div class="col-6">
                    <button type="submit"
                            class="btn btn-lg btn-primary w-100">
                        {{__('auth.login.button')}}
                    </button>
                </div>
                <div class="col-6">
                    @if (Route::has('password.request'))
                        <a class="btn btn-lg btn-link text-primary text-center w-100"
                           role="button"
                           href="{{ route('password.request') }}">
                            {{ __('auth.passwords.forgot') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
