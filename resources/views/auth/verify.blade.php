@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        {{ __('auth.verify.action') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success"
                                 role="alert">
                                {{ __(session('success')) }}
                                <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="Close">
                                    <span aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                            </div>
                        @endif
                        {{__('auth.verify.message')}}
                        <form class="d-inline"
                              method="POST"
                              action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">
                                {{ __('auth.verify.button') }}.
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
