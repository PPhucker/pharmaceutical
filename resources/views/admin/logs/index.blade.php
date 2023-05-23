@extends('layouts.app')
@section('content')
    <x-forms.main title="{{__('logs.logs')}}">
        <x-tables.main id="logs"
                       targets="-1">
            <x-slot name="filter">
                <div class="list-inline-item">
                    <form action="{{route('logs.index')}}"
                          method="GET">
                        <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                                      toDate="{{$toDate}}"/>

                        <x-tables.filters.select-filter title="{{__('users.user')}}"
                                                        name="user">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if((int)request('user') === $user->id) selected @endif>
                                    {{$user->name}}
                                </option>
                            @endforeach
                        </x-tables.filters.select-filter>

                        <x-tables.filters.select-filter title="{{__('logs.actions.action')}}"
                                                        name="action">
                            @foreach($actions as $action)
                                <option value="{{$action}}" @if(request('action') === $action) selected @endif>
                                    {{__('logs.actions.' . $action)}}
                                </option>
                            @endforeach
                        </x-tables.filters.select-filter>

                        <x-tables.filters.select-filter title="{{__('logs.model')}}"
                                                        name="model">
                            @foreach($models as $model)
                                <option value="{{$model['class']}}" @if(request('model') === $model['class']) selected @endif>
                                    {{$model['comment']}}
                                </option>
                            @endforeach
                        </x-tables.filters.select-filter>

                        <button type="submit"
                                class="btn btn-sm btn-primary">
                            {{__('datatable.filter')}}
                        </button>
                    </form>
                </div>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center">
                    {{__('users.user')}}
                </th>
                <th scope="col"
                    class="text-center">
                    IP
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('logs.actions.action')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('logs.model')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('logs.primary_key')}}
                </th>
                <th scope="col"
                    class="text-center">
                    {{__('logs.time')}}
                </th>
                <th scope="col"
                    class="text-center">
                </th>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($logs as $key => $log)
                <tr>
                    <td class="align-middle text-left">
                        {{$log->get('context')->user->name}}
                    </td>
                    <td class="align-middle text-center">
                        {{$log->get('context')->user->ip}}
                    </td>
                    <td class="align-middle text-left">
                        {{__('logs.actions.' . $log->get('context')->action)}}
                    </td>
                    <td class="align-middle text-left">
                        {{__('models.' . str_replace('\\', '.', $log->get('context')->model))}}
                    </td>
                    <td class="align-middle text-center">
                        {{$log->get('context')->primary_key}}
                    </td>
                    <td class="align-middle text-center">
                        {{$log->get('datetime')}}
                    </td>
                    <td class="align-middle text-center">
                        <button class="btn btn-hover"
                                data-bs-toggle="collapse"
                                data-bs-target="#log{{$key}}"
                                aria-expanded="true"
                                aria-controls="log{{$key}}"
                                title="{{__('datatable.entries.show')}}">
                            <i class="bi bi-eye-fill fs-6"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
        @foreach($logs as $key => $log)
            <div class="collapse mt-2" id="log{{$key}}">
                <form class="form-control form-control-sm text-primary">
                    <div class="row mb-3">
                        <label for="f-action"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('logs.actions.action')}}
                        </label>
                        <div class="col-md">
                            <input id="f-action"
                                   class="form-control form-control-sm"
                                   value="{{__('logs.actions.' . $log->get('context')->action)}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="f-datetime"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('logs.time')}}
                        </label>
                        <div class="col-md">
                            <input id="f-datetime"
                                   class="form-control form-control-sm"
                                   value="{{$log->get('datetime')}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="f-user"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('users.user')}}
                        </label>
                        <div class="col-md">
                            <div class="card-body p-0">
                                <div class="row">
                                    <label for="f-user-id"
                                           class="col-md-2 col-form-label text-md-end">
                                        ID
                                    </label>
                                    <div class="col-md">
                                        <input id="f-user-id"
                                               class="form-control form-control-sm"
                                               value="{{$log->get('context')->user->id}}"
                                               disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="f-user-ip"
                                           class="col-md-2 col-form-label text-md-end">
                                        IP
                                    </label>
                                    <div class="col-md">
                                        <input id="f-user-ip"
                                               class="form-control form-control-sm"
                                               value="{{$log->get('context')->user->ip}}"
                                               disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="f-user-name"
                                           class="col-md-2 col-form-label text-md-end">
                                        {{__('users.name')}}
                                    </label>
                                    <div class="col-md">
                                        <input id="f-user-name"
                                               class="form-control form-control-sm"
                                               value="{{$log->get('context')->user->name}}"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="f-model"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('logs.model')}}
                        </label>
                        <div class="col-md">
                            <input id="f-model"
                                   class="form-control form-control-sm"
                                   value="{{ $log->get('context')->model}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="f-table"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('logs.table')}}
                        </label>
                        <div class="col-md">
                            <input id="f-table"
                                   class="form-control form-control-sm"
                                   value="{{ $log->get('context')->table}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="f-item-id"
                               class="col-md-2 col-form-label text-md-end fw-bold">
                            {{__('logs.primary_key')}}
                        </label>
                        <div class="col-md">
                            <input id="f-item-id"
                                   class="form-control form-control-sm"
                                   value="{{ $log->get('context')->primary_key}}"
                                   disabled>
                        </div>
                    </div>
                    @if (isset($log->get('context')->changes->attributes))
                        <div class="row mb-3">
                            <label for="f-user"
                                   class="col-md-2 col-form-label text-md-end fw-bold">
                                {{__('logs.changes')}}
                            </label>
                            <div class="col-md">
                                <div class="card-body p-0">
                                    @foreach($log->get('context')->changes->attributes as $name => $attribute)
                                        <div class="row">
                                            <label for="f-attribute-{{$name}}"
                                                   class="col-md-2 col-form-label text-md-end">
                                                {{$name}}
                                            </label>
                                            @if($log->get('context')->action === 'update')
                                                <div class="input-group input-group-sm col-md mb-1"
                                                     id="f-attribute-{{$name}}">
                                                   <span class="input-group-text">
                                                       {{__('logs.before')}}
                                                   </span>
                                                    <input class="form-control form-control-sm"
                                                           value="{{$attribute->before}}"
                                                           disabled>
                                                    <span class="input-group-text">
                                                       {{__('logs.after')}}
                                                   </span>
                                                    <input class="form-control form-control-sm"
                                                           value="{{$attribute->after}}"
                                                           disabled>
                                                </div>
                                            @elseif(in_array($log->get('context')->action, ['create', 'attach', 'detach']))
                                                <div class="col-md">
                                                    <input id="f-attribute-{{$name}}"
                                                           class="form-control form-control-sm"
                                                           value="{{$attribute}}"
                                                           disabled>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        @endforeach
    </x-forms.main>
@endsection
