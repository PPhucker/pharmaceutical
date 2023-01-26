@extends('layouts.app')
@section('content')
    <div class="container-fluid col-12 col-md-6">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    {{__('auth.login.action')}}
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('login') }}">
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end">
                                E-Mail
                            </label>

                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control
                                       @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="email"
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
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end">
                                {{__('auth.passwords.password')}}
                            </label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control
                                       @error('password') is-invalid @enderror"
                                       name="password"
                                       required
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
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"
                                        class="btn btn-primary">
                                    {{__('auth.login.button')}}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link"
                                       href="{{ route('password.request') }}">
                                        {{ __('auth.passwords.forgot') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
