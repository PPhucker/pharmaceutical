@extends('errors::illustrated-layout')

@section('title', __('errors.404.message'))
@section('code', '404')
@section('message', __('errors.404.message'))
@section('image')
    <img src="{{ asset('/images/molecular_shape.png') }}" class="float-end"
         style="max-width: 100%; max-height: 100vh; height: auto">
@endsection
