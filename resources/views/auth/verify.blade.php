@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        {{ __('Email Verification') }}
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
                        {{ __('Please check your corporate email for a verification link before proceeding.') }}
                        {{ __('If you have not received an email, please click on this link.') }}
                        <form class="d-inline"
                              method="POST"
                              action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">
                                {{ __('Send Mail Again') }}.
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
