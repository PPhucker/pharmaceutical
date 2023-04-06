@extends('layouts.app')
@section('content')
    <div class="row m-0" style="max-width: 100vw">
        <div class="d-flex justify-content-center align-items-center col-md-6 p-0">
            <div class="col-md-6 col-10 m-3">
                @yield('auth')
            </div>
        </div>
        <div class="d-none d-md-block d-flex justify-content-end col-md-6 p-0" style="position: relative">
            <img src="{{ asset('/images/molecular_shape.png') }}" class="float-end"
                 style="max-width: 100%; height: 100vh">
        </div>
    </div>
@endsection
