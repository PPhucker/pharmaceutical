@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('bills.index')}}"
                      title="
                  {{__('documents.shipment.bills.bill')
                    . ' №'
                    . $number
                    . ' '
                    . $date}}
                  ">
       @include('templates.documents.shipment.bill.main')
    </x-forms.document>
@endsection
