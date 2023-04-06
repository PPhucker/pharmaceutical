@extends('layouts.auth')
@section('auth')
        <h1 class="text-primary mb-3">
            {{ __('auth.verify.action') }}
        </h1>
        <form class="d-inline"
              method="POST"
              action="{{ route('verification.send') }}">
            @csrf
            <p class="fw-lighter fs-5">
                {{__('auth.verify.message')}}
            </p>
            <button type="submit"
                    class="btn btn-primary">
                {{ __('auth.verify.button') }}
            </button>
        </form>
@endsection
