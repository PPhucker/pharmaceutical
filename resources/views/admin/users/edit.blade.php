@extends('layouts.app')
@section('content')
    <x-notification.alert/>
    <x-card
        :title="__('users.edit_card')"
        :back="route('users.index')">
        <x-form
            :route="route('users.update', ['user' => $user->id])"
            formId="users_main_form"
            method="PATCH">
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="name"
                        :text="__('users.name')"/>
                </x-slot>
                <x-form.element.input
                    id="name"
                    name="name"
                    :value="$user->name"
                    :required="true"/>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="email"
                        text="Email"/>
                </x-slot>
                <x-form.element.input
                    id="email"
                    name="email"
                    type="email"
                    :value="$user->email"
                    :required="true"/>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="organizations"
                        :text="__('contractors.organizations.organizations')"/>
                </x-slot>
                <div class="col-md-6 pt-2">
                    @foreach($organizations as $organization)
                        <div class="form-check form-switch ps-1">
                            <x-form.element.input
                                type="checkbox"
                                name="organizations[]"
                                class="form-check-input"
                                id="organization-{{$organization->id}}"
                                :value="$organization->id"
                                :checked="$user->hasOrganization([$organization->id])"/>
                            <label class="form-check-label"
                                   for="organization-{{$organization->id}}">
                                {{$organization->full_name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="roles"
                        :text="__('auth.roles')"/>
                </x-slot>
                <div class="col-md-6 pt-2">
                    @foreach($roles as $role)
                        <div class="form-check form-switch ps-1">
                            <x-form.element.input
                                type="checkbox"
                                name="roles[]"
                                class="form-check-input"
                                :id="$role->slug"
                                :value="$role->slug"
                                :checked="$user->hasRole([$role->slug])"/>
                            <label class="form-check-label"
                                   for="{{$role->slug}}">
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="permissions"
                        :text="__('auth.permissions')"/>
                </x-slot>
                <div class="col-md-6 pt-2">
                    @foreach($permissions as $permission)
                        <div class="form-check form-switch ps-1">
                            <x-form.element.input
                                type="checkbox"
                                name="permissions[]"
                                class="form-check-input"
                                :id="$permission->slug"
                                :value="$permission->slug"
                                :checked="$user->hasPermission([$permission->slug])"/>
                            <label class="form-check-label"
                                   for="{{$permission->slug}}">
                                {{$permission->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </x-form.row>
            <footer class="mt-auto me-auto ps-2">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <x-form.button.save formId="users_main_form"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
