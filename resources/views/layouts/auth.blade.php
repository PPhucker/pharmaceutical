@extends('layouts.app')
@section('content')
    <div class="row m-0">
        <div class="d-flex justify-content-center align-items-center col-lg-6 p-0">
            <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
                <div class="row">
                    @yield('auth')
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block d-flex justify-content-end col-lg-6 p-0" style="position: relative;">
            <img src="{{ asset('/images/molecular_shape.png') }}" class="float-end"
                 style="max-width: 100%; max-height: 100vh;">
        </div>
    </div>
@endsection
