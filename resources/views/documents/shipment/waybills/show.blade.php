@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('waybills.index')}}"
                      title="
                  {{__('documents.shipment.waybills.waybill')
                    . ' №'
                    . $waybill->number
                    . ' '
                    . $waybill->date}}
                  ">
        @include('templates.documents.shipment.waybill.main')
    </x-forms.document>
@endsection
