@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('users.users')}}">
        <x-tables.main id="users"
                       targets='-1,-2'>
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="users"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('ID')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('users.name')}}
                </th>
                <th scope="col"
                    class="text-center">
                    E-mail
                </th>
                <th scope="col"
                    class="text-center d-none d-lg-table-cell">
                    {{__('users.verified')}}
                </th>
                <th scope="col"
                    class="text-center d-none d-lg-table-cell">
                    {{__('users.registration_date')}}
                </th>
                <th scope="col"
                    class="text-center">
                </th>
                <th scope="col"
                    class="text-center">
                </th>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($users as $key => $user)
                <tr @if($user->trashed()) class="d-none trashed" @endif>
                    <td class="align-middle text-center">
                        {{$user->id}}
                    </td>
                    <td class="align-middle">
                        {{$user->name}}
                    </td>
                    <td class="align-middle">
                        {{$user->email}}
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        @if($user->email_verified_at)
                            <span class="d-none">{{true}}</span>
                            <i class="bi bi-check-circle text-success"></i>
                        @else
                            <span class="d-none">{{false}}</span>
                            <i class="bi bi-exclamation-circle text-danger"></i>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        {{$user->created_at}}
                    </td>
                    <td class="text-center align-middle">
                        <x-buttons.edit route="{{route('users.edit', ['user' => $user->id])}}"
                                        disabled="{{$user->trashed()}}"/>
                    </td>
                    <td class="text-center align-middle">
                        @if ($user->trashed())
                            <x-buttons.restore route="{{route('users.restore', ['user' => $user->id])}}"
                                               itemId="{{$user->id}}"/>
                        @else
                            <x-buttons.delete route="{{route('users.destroy', ['user' => $user->id])}}"
                                              formId="destroy"
                                              itemId="{{$user->id}}"/>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-forms.main>
@endsection
