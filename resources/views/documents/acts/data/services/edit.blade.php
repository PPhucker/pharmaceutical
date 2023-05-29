@roles(['marketing', 'bookkeeping'])
<x-forms.collapse.creation cardId="div_add_act_service"
                           errorName="act_service.*">
    <x-slot name="cardBody">
        <form id="form_add_act_service"
              method="POST"
              action="{{route('act_services.store')}}">
            @csrf
            <input type="hidden"
                   name="act_service[act_id]"
                   value="{{$act->id}}">
            <x-forms.row id="service_id"
                         label="{{__('documents.acts.data.service_id')}}">
                <select id="service_id"
                        name="act_service[service_id]"
                        class="form-control form-control-sm text-primary
                        @error('act_service.service_id') is-invalid @enderror"
                        required>
                    @foreach($services as $service)
                        <option value="{{$service->id}}"
                                @if($service->id === (int)(old('act_service.service_id')))
                                    selected
                            @endif>
                            {{$service->name}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="act_service.service_id"/>
            </x-forms.row>
            <x-forms.row id="quantity"
                         label="{{__('documents.acts.data.quantity')}}">
                <input id="qauntity"
                       name="act_service[quantity]"
                       class="form-control form-control-sm text-primary
                       @error('act_service.quantity') is-invalid @enderror"
                       value="{{old('act_service.quantity')}}"
                       required>
                <x-forms.span-error name="iact_service.quantity"/>
            </x-forms.row>
            <x-forms.row id="price"
                         label="{{__('documents.acts.data.price')}}">
                <div class="input-group input-group-sm">
                    <input id="price"
                           name="act_service[price]"
                           class="form-control form-control-sm text-primary
                       @error('act_service.price') is-invalid @enderror"
                           value="{{old('act_service.price')}}"
                           required>
                    <span class="input-group-text">
                        {{__('currency.rub')}}
                    </span>
                </div>
                <x-forms.span-error name="act_service.price"/>
            </x-forms.row>
            <x-forms.row id="nds"
                         label="{{__('documents.acts.data.nds')}}">
                <div class="input-group input-group-sm">
                    <input id="nds"
                           name="act_service[nds]"
                           class="form-control form-control-sm text-primary
                       @error('act_service.nds') is-invalid @enderror"
                           value="{{old('act_service.nds')}}"
                           required>
                    <span class="input-group-text">
                        %
                    </span>
                </div>

                <x-forms.span-error name="act_service.nds"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_act_service"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card
    route="{{route('act_services.update', ['act_service' => $act->production->first()->id ?? 1])}}"
    cardId="card_act_services"
    formId="form_act_services"
    title="{{__('documents.acts.data.data')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_act_services"
                       targets="-1">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_act_services"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.acts.data.service_id')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.acts.data.quantity')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.acts.data.price')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('documents.acts.data.nds')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($act->production as $key => $actService)
                <tr @if($actService->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="act_services[{{$key}}][id]"
                           value="{{$actService->id}}">
                    <input type="hidden"
                           name="act_services[{{$key}}][service_id]"
                           value="{{$actService->service->id}}">
                    <td class="align-middle border-start">
                        {{$actService->service->name}}
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$actService->quantity}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="act_services[{{$key}}][quantity]"
                                   class="form-control form-control-sm text-primary
                                   @error('act_services.' . $key. '.quantity') is-invalid @enderror"
                                   value="{{$actService->quantity}}"
                                   required>
                            <x-forms.span-error name="{{'act_services.' . $key. '.quantity'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$actService->price}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="act_services[{{$key}}][price]"
                                   class="form-control form-control-sm text-primary
                                   @error('act_services.' . $key. '.price') is-invalid @enderror"
                                   value="{{$actService->price}}"
                                   required>
                            <span class="input-group-text">
                                    {{__('currency.rub')}}
                                </span>
                            <x-forms.span-error name="{{'act_services.' . $key. '.price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                            <span class="d-none">
                                {{$actService->nds * 100}}
                            </span>
                        <div class="input-group input-group-sm mb-0 pt-1 pb-1">
                            <input type="text"
                                   name="act_services[{{$key}}][nds]"
                                   class="form-control form-control-sm text-primary
                                   @error('act_services.' . $key. '.nds') is-invalid @enderror"
                                   value="{{$actService->nds * 100}}"
                                   required>
                            <span class="input-group-text">%</span>
                            <x-forms.span-error name="{{'act_services.' . $key. '.nds'}}"/>
                        </div>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($actService->trashed())
                            <x-buttons.restore
                                route="{{route('act_services.restore', ['act_service' => $actService->id])}}"
                                itemId="{{$actService->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('act_services.destroy', ['act_service' => $actService->id])}}"
                                formId="destroy"
                                itemId="{{$actService->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_add_act_service"/>
        @if(count($act->production) > 0)
            <x-buttons.save formId="form_act_services"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
@end_roles
