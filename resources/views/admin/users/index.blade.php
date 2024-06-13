@extends('layouts.app')
@section('content')
    <x-card
        :title="__('users.users')">
        <x-notification.alert/>
        <x-data-table.table
            id="users_table"
            class="table-bordered"
            targets="-1,-2,-3"
            type="index">
            <x-slot name="filter">
                <x-data-table.filter.trashed-filter tableId="users_table"/>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    :text="__('users.name')"/>
                <x-data-table.th
                    text="Email"/>
                <x-data-table.th
                    :text="__('users.verified')"/>
                <x-data-table.th
                    :text="__('users.registration_date')"/>
                <x-data-table.th/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($users as $key => $user)
                    <x-data-table.tr
                        :model="$user">
                        <x-data-table.td
                            class="text-start">
                            {{$user->name}}
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{$user->email}}
                        </x-data-table.td>
                        <x-data-table.td>
                            @if($user->email_verified_at)
                                <span class="d-none">{{true}}</span>
                                <i class="bi bi-check-circle text-success"></i>
                            @else
                                <span class="d-none">{{false}}</span>
                                <i class="bi bi-exclamation-circle text-danger"></i>
                            @endif
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$user->created_at}}
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.edit
                                route="{{route('users.edit', ['user' => $user->id])}}"
                                disabled="{{$user->trashed()}}"/>
                        </x-data-table.td>
                        <x-data-table.td>
                            <x-data-table.button.soft-delete
                                :trashed="$user->trashed()"
                                :id="$user->id"
                                route="users"
                                :params="['user' => $user->id]"/>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
    </x-card>
@endsection
