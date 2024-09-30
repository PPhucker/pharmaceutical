@extends('layouts.app')
@section('content')
    <x-card
        :title="__('logs.logs')">
        <x-notification.alert/>
        <x-data-table.table
            id="logs_table"
            class="table-bordered"
            targets="-1"
            type="index"
            pageLength="25">
            <x-slot name="filter">
                <form
                    id="filter_form"
                    action="{{route('logs.index')}}">
                    <div class="list-inline">
                        <x-data-table.filter.date-filter
                            :startDate="$startDate"
                            :endDate="$endDate"/>
                        <x-data-table.filter.select-filter
                            name="user"
                            :title="__('users.user')">
                            @foreach($users as $user)
                                <x-form.element.option
                                    :value="$user->id"
                                    :text="$user->name"
                                    :selected="(int)request('user') === $user->id"/>
                            @endforeach
                        </x-data-table.filter.select-filter>
                        <x-data-table.filter.select-filter
                            name="action"
                            :title="__('logs.actions.action')">
                            @foreach($actions as $action)
                                <x-form.element.option
                                    :value="$action"
                                    :text="__('logs.actions.' . $action)"
                                    :selected="request('action') === $action"/>
                            @endforeach
                        </x-data-table.filter.select-filter>
                        <x-data-table.filter.select-filter
                            name="model"
                            :title="__('logs.model')">
                            @foreach($models as $model)
                                <x-form.element.option
                                    :value="$model['class']"
                                    :text="$model['comment']"
                                    :selected="request('model') === $model['class']"/>
                            @endforeach
                        </x-data-table.filter.select-filter>
                        <div class="list-inline-item">
                            <x-form.button.save
                                class="btn-sm"
                                formId="filter_form"
                                :text="__('datatable.filter')"/>
                        </div>
                    </div>
                </form>
            </x-slot>
            <x-data-table.head>
                <x-data-table.th
                    :text="__('users.user')"/>
                <x-data-table.th
                    text="IP"/>
                <x-data-table.th
                    :text="__('logs.actions.action')"/>
                <x-data-table.th
                    :text="__('logs.model')"/>
                <x-data-table.th
                    :text="__('logs.primary_key')"/>
                <x-data-table.th
                    :text="__('logs.time')"/>
                <x-data-table.th/>
            </x-data-table.head>
            <x-data-table.body>
                @foreach($logs as $key => $log)
                    <x-data-table.tr>
                        <x-data-table.td
                            class="text-start">
                            {{$log->get('context')->user->name}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$log->get('context')->user->ip}}
                        </x-data-table.td>
                        <x-data-table.td class="text-start">
                            {{__('logs.actions.' . $log->get('context')->action)}}
                        </x-data-table.td>
                        <x-data-table.td
                            class="text-start">
                            {{__('models.' . str_replace('\\', '.', $log->get('context')->model))}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$log->get('context')->primary_key}}
                        </x-data-table.td>
                        <x-data-table.td>
                            {{$log->get('datetime')}}
                        </x-data-table.td>
                        <x-data-table.td>
                            <button type="button"
                                    title="{{__('datatable.entries.show')}}"
                                    class="btn btn-hover"
                                    data-bs-toggle="modal"
                                    data-bs-target="#log{{$key}}">
                                <i class="bi bi-eye-fill fs-6"></i>
                            </button>
                        </x-data-table.td>
                    </x-data-table.tr>
                @endforeach
            </x-data-table.body>
        </x-data-table.table>
        @foreach($logs as $key => $log)
            <div class="modal fade"
                 aria-hidden="true"
                 id="log{{$key}}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr class="align-middle">
                                    <td class="text-primary fw-bolder">
                                        {{__('logs.actions.action')}}
                                    </td>
                                    <td colspan="5">
                                        <mark>{{__('logs.actions.' . $log->get('context')->action)}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-primary fw-bolder">
                                        {{__('logs.time')}}
                                    </td>
                                    <td colspan="5">
                                        <mark>{{$log->get('datetime')}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td rowspan="3"
                                        class="text-primary fw-bolder">
                                        {{__('users.user')}}
                                    </td>
                                    <td>
                                        ID
                                    </td>
                                    <td colspan="4">
                                        <mark>{{$log->get('context')->user->id}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>
                                        IP
                                    </td>
                                    <td colspan="4">
                                        <mark>{{$log->get('context')->user->ip}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>
                                        {{__('users.name')}}
                                    </td>
                                    <td colspan="4">
                                        <mark>{{$log->get('context')->user->name}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-primary fw-bolder">
                                        {{__('logs.model')}}
                                    </td>
                                    <td colspan="5">
                                        <mark>{{$log->get('context')->model}}</mark>
                                        ({{__('models.' . str_replace('\\', '.', $log->get('context')->model))}})
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-primary fw-bolder">
                                        {{__('logs.table')}}
                                    </td>
                                    <td colspan="5">
                                        <mark>{{$log->get('context')->table}}</mark>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td class="text-primary fw-bolder">
                                        {{__('logs.primary_key')}}
                                    </td>
                                    <td colspan="5">
                                        <mark>{{$log->get('context')->primary_key}}</mark>
                                    </td>
                                </tr>
                                @if (isset($log->get('context')->changes->attributes))
                                    @foreach($data = (array)$log->get('context')->changes->attributes as $name => $attribute)
                                        <tr class="align-middle">
                                            @if($name === array_key_first($data))
                                                <td rowspan="{{count($data)}}"
                                                    class="text-primary fw-bolder">
                                                    {{__('logs.changes')}}
                                                </td>
                                            @endif
                                            @if(in_array($log->get('context')->action, ['create', 'attach', 'detach', 'login_failed']))
                                                <td>
                                                    {{$name}}
                                                </td>
                                                <td>
                                                    <mark>{{$attribute}}</mark>
                                                </td>
                                            @else
                                                <td>
                                                    {{$name}}
                                                </td>
                                                <td>
                                                    {{__('logs.before')}}:
                                                </td>
                                                <td>
                                                    <mark>{{$attribute->before ?? ''}}</mark>
                                                </td>
                                                <td>
                                                    {{__('logs.after')}}:
                                                </td>
                                                <td>
                                                    <mark>{{$attribute->after ?? ''}}</mark>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>
@endsection
