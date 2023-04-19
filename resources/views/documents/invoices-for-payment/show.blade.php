@extends('layouts.app')
@section('content')
    {{--{{dd($data)}}--}}
    <x-forms.document back="{{route('invoices_for_payment.index')}}"
                      title="
                  {{__('documents.invoices_for_payment.invoice_for_payment')
                    . ' №'
                    . $invoiceForPayment->number
                    . ' '
                    . $invoiceForPayment->date}}
                  ">
        @include('templates.documents.invoice_for_payment')
    </x-forms.document>
@endsection
