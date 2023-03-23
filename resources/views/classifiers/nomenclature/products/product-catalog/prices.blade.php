<x-forms.collapse.creation cardId="div_add_price"
                           errorName="product_price.*">
    <x-slot name="cardBody">
        <form id="form_add_product_price"
              method="POST"
              action="{{route('product_prices.store')}}">
            @csrf
            <input type="hidden"
                   name="product_price[product_catalog_id]"
                   value="{{$product->id}}">
            <x-forms.row id="organization_id"
                         label="{{__('classifiers.nomenclature.products.product_prices.organization_id')}}">
                <select id="organization_id"
                        name="product_price[organization_id]"
                        class="form-control form-control-sm text-primary
                        @error('product_price.organization_id') is-invalid @enderror"
                        required>
                    @foreach($organizations as $organization)
                        <option value="{{$organization->id}}"
                                @if($organization->id === (int)(old('product_price.organization_id')))
                                    selected
                            @endif>
                            {{$organization->name}}
                        </option>
                    @endforeach
                </select>
                <x-forms.span-error name="product_price.organization_id"/>
            </x-forms.row>
            <x-forms.row id="retail_price"
                         label="{{__('classifiers.nomenclature.products.product_prices.retail_price')}}">
                <div class="input-group input-group-sm">
                    <input id="retail_price"
                           name="product_price[retail_price]"
                           class="form-control form-control-sm text-primary
                      @error('product_price.retail_price') is-invalid @enderror"
                           value="{{old('product_price.retail_price')}}"
                           required>
                    <span class="input-group-text">
                        {{__('currency.rub')}}
                    </span>
                    <x-forms.span-error name="product_price.retail_price"/>
                </div>
            </x-forms.row>
            <x-forms.row id="trade_price"
                         label="{{__('classifiers.nomenclature.products.product_prices.trade_price')}}">
                <div class="input-group input-group-sm">
                    <input id="trade_price"
                           name="product_price[trade_price]"
                           class="form-control form-control-sm text-primary
                           @error('product_price.trade_price') is-invalid @enderror"
                           value="{{old('product_price.trade_price')}}">
                    <span class="input-group-text">
                                {{__('currency.rub')}}
                            </span>
                    <x-forms.span-error name="product_price.trade_price"/>
                </div>
            </x-forms.row>
            <x-forms.row id="trade_quantity"
                         label="{{__('classifiers.nomenclature.products.product_prices.trade_quantity')}}">
                <input id="trade_quantity"
                       name="product_price[trade_quantity]"
                       class="form-control form-control-sm text-primary
                       @error('product_price.trade_quantity') is-invalid @enderror"
                       value="{{old('product_price.trade_quantity')}}">
                <x-forms.span-error name="product_price.trade_quantity"/>
            </x-forms.row>
            <x-forms.row id="nds"
                         label="{{__('classifiers.nomenclature.products.product_prices.nds')}}">
                <div class="input-group input-group-sm">
                    <input id="nds"
                           name="product_price[nds]"
                           class="form-control form-control-sm text-primary
                           @error('product_price.nds') is-invalid @enderror"
                           value="{{old('product_price.nds')}}"
                           required>
                    <span class="input-group-text">
                                %
                           </span>
                    <x-forms.span-error name="product_price.nds"/>
                </div>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_product_price"/>
    </x-slot>
</x-forms.collapse.creation>
<x-forms.collapse.card route="{{route('product_prices.update', ['product_price' => $product->prices->first()->id ?? 1])}}"
        cardId="card_product_prices"
        formId="form_product_prices"
        title="{{__('classifiers.nomenclature.products.product_prices.product_prices')}}">
    <x-slot name="cardBody">
        <x-tables.main id="table_product_prices"
                       targets="-1">
            <x-slot name="filter">
                <x-tables.filters.trashed-filter tableId="table_product_prices"/>
            </x-slot>
            <thead class="bg-secondary">
            <tr class="text-primary">
                <th scope="col"
                    class="text-center align-middle">
                    {{__('ID')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.product_prices.organization_id')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.product_prices.retail_price')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.product_prices.trade_price')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.product_prices.trade_quantity')}}
                </th>
                <th scope="col"
                    class="text-center align-middle">
                    {{__('classifiers.nomenclature.products.product_prices.nds')}}
                </th>
                <x-tables.columns.thead.delete/>
            </tr>
            </thead>
            <tbody class="text-primary">
            @foreach($product->prices as $key => $price)
                <tr @if($price->trashed()) class="d-none trashed" @endif>
                    <input type="hidden"
                           name="product_prices[{{$key}}][id]"
                           value="{{$price->id}}">
                    <input type="hidden"
                           name="product_prices[{{$key}}][product_catalog_id]"
                           value="{{$product->id}}">
                    <td class="align-middle text-center border-start">
                        {{$price->id}}
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                            {{$price->organization->name}}
                        </span>
                        <select name="product_prices[{{$key}}][organization_id]"
                                class="form-control form-control-sm text-primary mt-1 mb-1
                                @error('product_prices.' .$key.  '.organization_id') is-invalid @enderror"
                                @if($price->trashed()) disabled @endif
                                required>
                            @foreach($organizations as $organization)
                                <option value="{{$organization->id}}"
                                        @if($organization->id === $price->organization_id)
                                            selected
                                    @endif>
                                    {{$price->organization->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.span-error name="{{'product_prices.' .$key. '.organization_id'}}"/>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                            {{$price->retail_price}}
                        </span>
                        <div class="input-group input-group-sm">
                            <input name="product_prices[{{$key}}][retail_price]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                                   @error('product_prices.' .$key. '.retail_price') is-invalid @enderror"
                                   @if($price->trashed()) disabled @endif
                                   value="{{$price->retail_price}}"
                                   required>
                            <span class="input-group-text mt-1 mb-1">
                                {{__('currency.rub')}}
                            </span>
                            <x-forms.span-error name="{{'product_prices.' .$key. '.retail_price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                                {{$price->trade_price}}
                        </span>
                        <div class="input-group input-group-sm">
                            <input name="product_prices[{{$key}}][trade_price]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('product_prices.' .$key. '.trade_price') is-invalid @enderror"
                                   @if($price->trashed()) disabled @endif
                                   value="{{$price->trade_price}}"
                                   required>
                            <span class="input-group-text mt-1 mb-1">
                            {{__('currency.rub')}}
                            </span>
                            <x-forms.span-error name="{{'product_prices.' .$key. '.trade_price'}}"/>
                        </div>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                            {{$price->trade_quantity}}
                        </span>
                        <input name="product_prices[{{$key}}][trade_quantity]"
                               class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('product_prices.' .$key. '.trade_quantity') is-invalid @enderror"
                               @if($price->trashed()) disabled @endif
                               value="{{$price->trade_quantity}}"
                               required>
                        <x-forms.span-error name="{{'product_prices.' .$key. '.trade_quantity'}}"/>
                    </td>
                    <td class="align-middle">
                        <span class="d-none">
                            {{$price->nds * 100}} %
                        </span>
                        <div class="input-group input-group-sm">
                            <input name="product_prices[{{$key}}][nds]"
                                   class="form-control form-control-sm text-primary mt-1 mb-1
                               @error('product_prices.' .$key. '.nds') is-invalid @enderror"
                                   @if($price->trashed()) disabled @endif
                                   value="{{$price->nds * 100}}"
                                   required>
                            <span class="input-group-text mt-1 mb-1">
                                {{__('currency.rub')}}
                            </span>
                            <x-forms.span-error name="{{'product_prices.' .$key. '.nds'}}"/>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        @if ($price->trashed())
                            <x-buttons.restore
                                route="{{route('product_prices.restore', ['product_price' => $price->id])}}"
                                itemId="{{$price->id}}"/>
                        @else
                            <x-buttons.delete
                                route="{{route('product_prices.destroy', ['product_price' => $price->id])}}"
                                formId="destroy"
                                itemId="{{$price->id}}"/>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-tables.main>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.collapse formId="div_add_price"/>
        @if(count($product->prices) > 0)
            <x-buttons.save formId="form_product_prices"/>
        @endif
    </x-slot>
</x-forms.collapse.card>
