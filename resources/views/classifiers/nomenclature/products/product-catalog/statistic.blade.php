@extends('layouts.app')
@section('content')
    <x-forms.main back="{{route('product_catalog.index')}}"
        title="{{__('classifiers.nomenclature.products.product_catalog.statistic')}} :
        {{$productCatalog->endProduct->short_name}} -
        {{$productCatalog->placeOfBusiness->address}}">
        <div class="list-inline-item">
            <form action="{{route('product_catalog.statistic', ['product_catalog' => $productCatalog->id])}}"
                  method="GET">
                <x-tables.filters.date-filter fromDate="{{$fromDate}}"
                                              toDate="{{$toDate}}"/>
                <button type="submit"
                        class="btn btn-sm btn-primary">
                    {{__('datatable.filter')}}
                </button>
            </form>
        </div>
        @foreach($contractors as $contractor)
                <?php
                $contractorQuantity = 0;
                $contractorSum = 0;
                ?>
            <x-forms.collapse.card
                route=""
                cardId="card_contractor_{{$contractor->id}}_statistic"
                formId="form_contractor_{{$contractor->id}}_statistic"
                title="{{$contractor->legal_form_type}} {!! $contractor->name !!}">
                <x-slot name="cardBody">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover text-nowrap w-100 mb-0">
                            <tbody class="text-primary">
                            <tr>
                                <th colspan="2" class="bg-secondary text-center align-middle">
                                    {{__('documents.shipment.packing_lists.packing_list')}}
                                </th>
                                <th class="bg-secondary text-center align-middle">
                                    {{__('documents.shipment.data.series')}}
                                </th>
                                <th class="bg-secondary text-center align-middle">
                                    {{__('documents.shipment.data.price')}}
                                </th>
                                <th class="bg-secondary text-center align-middle">
                                    {{__('documents.shipment.data.quantity')}}
                                </th>
                                <th class="bg-secondary text-center align-middle">
                                    {{__('documents.shipment.data.sum')}}
                                </th>
                            </tr>
                            @foreach($contractor->packingLists as $packingList)
                                    <?php
                                    $packingListSum = 0;
                                    $packingListQuantity = 0 ?>

                                @foreach($packingList->production as $key => $product)
                                        <?php
                                        $sum = $product->price * $product->quantity;
                                        $packingListSum += $sum;
                                        $packingListQuantity += $product->quantity ?>
                                    @if($key > 0)
                                        <tr>
                                            <td class="align-middle text-center">
                                                {{$product->series}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{Str::priceFormat($product->price)}} {{__('currency.rub')}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{$product->quantity}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{Str::priceFormat($sum)}} {{__('currency.rub')}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="2" rowspan="{{count($packingList->production) + 1}}"
                                                class="text-start align-middle">
                                            <span
                                                class="fw-bold">№{{$packingList->number}}</span> {{$packingList->date}}
                                            </td>

                                            <td class="align-middle text-center">
                                                {{$product->series}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{Str::priceFormat($product->price)}} {{__('currency.rub')}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{$product->quantity}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{Str::priceFormat($sum)}} {{__('currency.rub')}}
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                                    <?php
                                    $contractorSum += $packingListSum;
                                    $contractorQuantity += $packingListQuantity;
                                    ?>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <span
                                            class="fw-bold">{{__('documents.shipment.data.total_by_packing_list')}}</span>
                                        : {{$packingListQuantity}}
                                    </td>
                                    <td>
                                        <span
                                            class="fw-bold">{{__('documents.shipment.data.total_by_packing_list')}}</span>
                                        : {{Str::priceFormat($packingListSum)}} {{__('currency.rub')}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-secondary">
                                <td colspan="4">
                                </td>
                                <td>
                                    <span
                                        class="fw-bold">{{__('documents.shipment.data.total')}}</span>: {{$contractorQuantity}}
                                </td>
                                <td>
                                    <span class="fw-bold">{{__('documents.shipment.data.total')}}</span>
                                    : {{Str::priceFormat($contractorSum)}} {{__('currency.rub')}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </x-slot>
            </x-forms.collapse.card>
        @endforeach
    </x-forms.main>
@endsection
