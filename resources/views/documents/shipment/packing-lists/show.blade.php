@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('packing_lists.index')}}"
                      title="
                  {{__('documents.shipment.packing_lists.packing_list')
                    . ' №'
                    . $packingList->number
                    . ' '
                    . $packingList->date}}
                  ">
        @include('templates.documents.shipment.packing-list.main')
    </x-forms.document>
@endsection
