@extends('errors::illustrated-layout')

@section('title', __('errors.403.message'))
@section('code', '403')
@section('message', __('errors.403.message'))
@section('image')
    <img src="{{ asset('/images/molecular_shape.png') }}" class="float-end"
         style="max-width: 100%; max-height: 100vh; height: auto">
@endsection
