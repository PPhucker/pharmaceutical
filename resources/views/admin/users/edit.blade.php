@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('users.index')}}"
                  title="{{__('users.action.edit', ['name' => $user->name])}}">
        <form method="POST"
              action="{{ route('users.update', ['user' => $user->id]) }}">
            @csrf
            @method('PATCH')
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
                           value="{{$user->name}}"
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
                           value="{{$user->email}}">
                    @error('email')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>
                            {{$message}}
                        </strong>
                    </span>
                    @enderror
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
                                   value="{{$role->slug}}"
                                   @foreach($user->roles as $userRole)
                                       @if($role->slug === $userRole->slug)
                                           checked
                                @endif
                                @endforeach
                            >
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
                                   value="{{$permission->slug}}"
                                   @foreach($user->permissions as $userPermission)
                                       @if($permission->slug === $userPermission->slug)
                                           checked
                                @endif
                                @endforeach>
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
                        {{__('form.button.save')}}
                    </button>
                </div>
            </div>
        </form>
    </x-forms.main>
@endsection
