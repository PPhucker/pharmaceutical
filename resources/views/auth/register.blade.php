@extends('layouts.app')
@section('content')
    <x-form back="{{route('users.index')}}"
            title="{{__('auth.register.action')}}">
        @if (session('success'))
            <div class="alert alert-success m-1 p-1"
                 role="alert">
                <svg class="bi flex-shrink-0 me-2"
                     width="24"
                     height="24"
                     role="img"
                     aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                {{ __(session('success')) }}
                <button type="button"
                        class="btn-close btn-sm align-middle"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>
            </div>
        @endif
        <form method="POST"
              action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
                <label for="name"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('users.name')}}
                </label>

                <div class="col-md-6">
                    <input id="name"
                           type="text"
                           class="form-control
                               @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
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
                           value="{{ old('email') }}">
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
                           name="password">
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
            <div class="row mb-3">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('auth.passwords.confirm.action')}}
                </label>
                <div class="col-md-6">
                    <input id="password-confirm"
                           type="password"
                           class="form-control"
                           name="password_confirmation"
                           required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="roles"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('auth.roles')}}
                </label>
                <div class="col-md-6 pt-2">
                    @foreach($roles as $role)
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="roles[]"
                                   id="{{$role->slug}}"
                                   value="{{$role->slug}}">
                            <label class="form-check-label"
                                   for="{{$role->slug}}">
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                    @error('roles')
                    <label class="text-danger">
                        <strong>
                            {{ $message }}
                        </strong>
                    </label>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="permissions"
                       class="col-md-4 col-form-label text-md-end">
                    {{__('auth.permissions')}}
                </label>
                <div class="col-md-6 pt-2">
                    @foreach($permissions as $permission)
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="permissions[]"
                                   id="{{$permission->slug}}"
                                   value="{{$permission->slug}}">
                            <label class="form-check-label"
                                   for="{{$permission->slug}}">
                                {{$permission->name}}
                            </label>
                        </div>
                    @endforeach
                    @error('permissions')
                    <label class="text-danger">
                        <strong>
                            {{ $message }}
                        </strong>
                    </label>
                    @enderror
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit"
                            class="btn btn-primary">
                        {{__('auth.register.button')}}
                    </button>
                </div>
            </div>
        </form>
    </x-form>
@endsection
