@extends('layouts.app')
@section('content')
    <x-forms.document title="
                  {{__('documents.acts.act')
                    . ' №'
                    . $act->number
                    . ' '
                    . $act->date}}
                  ">
        @include('templates.documents.act')
    </x-forms.document>
@endsection
