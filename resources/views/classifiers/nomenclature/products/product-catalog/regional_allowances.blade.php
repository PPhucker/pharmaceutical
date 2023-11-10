@roles(['marketing', 'bookkeeping'])
<x-forms.collapse.creation cardId="div_add_regional_allowance"
                           errorName="product_regional_allowance.*">
    <x-slot name="cardBody">
        <form id="form_add_product_regional_allowance"
              method="POST"
              action="{{route('product_regional_allowances.store')}}">
            @csrf
            <input type="hidden"
                   name="product_regional_allowance[product_catalog_id]"
                   value="{{$product->id}}">
            <x-forms.row id="region_id"
                         label="{{__('classifiers.nomenclature.products.regional_allowances.region_id')}}">
                <select id="region_id"
                        name="product_regional_allowance[region_id]"
                        class="form-control form-control-sm text-primary
                        @error('product_regional_allowance.region_id') is-invalid @enderror"
                        required>
                    @foreach($regions as $region)
                        <option value="{{$region->id}}"
                                @if($region->id === (int)(old('product_regional_allowance.region_id')))
                                    selected
                            @endif>
                            {{$region->name}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="product_regional_allowance.region_id"/>
            </x-forms.row>
            <x-forms.row id="allowance"
                         label="{{__('classifiers.nomenclature.products.regional_allowances.allowance')}}">
                <div class="input-group input-group-sm">
                    <input id="allowance"
                           name="product_regional_allowance[allowance]"
                           class="form-control form-control-sm text-primary
                      @error('product_regional_allowance.allowance') is-invalid @enderror"
                           value="{{old('product_regional_allowance.allowance')}}"
                           required>
                    <span class="input-group-text">
                        {{__('%')}}
                    </span>
                    <x-forms.span-error name="product_regional_allowance.allowance"/>
                </div>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_product_regional_allowance"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card
    route="{{route('product_regional_allowances.update',
            ['product_regional_allowance' => $product->regionalAllowances->first()->id ?? 1])}}"
    cardId="card_product_regional_allowances"
    formId="form_product_regional_allowances"
    title="{{__('classifiers.nomenclature.products.regional_allowances.regional_allowances')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_product_regional_allowances"
                       targets="-1">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_product_regional_allowances"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.regional_allowances.region_id')}}
                </th>
                <th scope="col"
                    class="text-center align-middle col-md-1">
                    {{__('classifiers.nomenclature.products.regional_allowances.allowance')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($product->regionalAllowances as $key => $allowance)
                <tr @if($allowance->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="product_regional_allowances[{{$key}}][id]"
                           value="{{$allowance->id}}">
                    <input type="hidden"
                           name="product_regional_allowances[{{$key}}][product_catalog_id]"
                           value="{{$product->id}}">
                    <td class="align-middle border-start">
                        <span class="d-none">
                            {{$allowance->region->name}}
                        </span>
                        <select name="product_regional_allowances[{{$key}}][region_id]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                @error('product_regional_allowances.' .$key.  '.region_id') is-invalid @enderror"
                                @if($allowance->trashed()) disabled @endif
                                required>
                            <option value="{{null}}">{{'-'}}</option>
                            @foreach($regions as $region)
                                <option value="{{$region->id}}"
                                        @if($region->id === ($allowance->region_id ?? null))
                                            selected
                                    @endif>
                                    {{$region->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="{{'product_regional_allowances.' .$key. '.region_id'}}"/>
                    </td>
                    <td class="align-middle col-md-1">
                        <span class="d-none">
                            {{$allowance->allowance}}
                        </span>
                        <div class="input-group input-group-sm">
                            <input name="product_regional_allowances[{{$key}}][allowance]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('product_regional_allowances.' .$key. '.allowance') is-invalid @enderror"
                                   @if($allowance->trashed()) disabled @endif
                                   value="{{$allowance->allowance * 100}}"
                                   required>
                            <span class="input-group-text mt-1 mb-1">
                                {{__('%')}}
                            </span>
                            <x-forms.span-error name="{{'product_regional_allowances.' .$key. '.allowance'}}"/>
                        </div>
                    </td>
                    <x-tables.columns.tbody.delete>
                        @if ($allowance->trashed())
                            <x-buttons.restore
                                route="{{route('product_regional_allowances.restore',
                                ['product_regional_allowance' => $allowance->id])}}"
                                itemId="{{$allowance->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('product_regional_allowances.destroy',
                                ['product_regional_allowance' => $allowance->id])}}"
                                formId="destroy"
                                itemId="{{$allowance->id}}"/>
                        @endif
                    </x-tables.columns.tbody.delete>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_add_regional_allowance"/>
        @if(count($product->prices) > 0)
            <x-buttons.save formId="form_product_regional_allowances"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
@end_roles
