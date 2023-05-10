@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('protocols.index')}}"
                      title="
                  {{__('documents.shipment.protocols.protocol')
                    . ' №'
                    . $number
                    . ' '
                    . $date}}
                  ">
       @include('templates.documents.shipment.protocol.main')
    </x-forms.document>
@endsection
