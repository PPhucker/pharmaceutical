@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('appendixes.index')}}"
                      title="
                  {{__('documents.shipment.appendixes.appendix')
                    . ' №'
                    . $number
                    . ' '
                    . $date}}
                  ">
        @include('templates.documents.shipment.appendix.main')
    </x-forms.document>
@endsection
