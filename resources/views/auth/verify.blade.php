@extends('layouts.app')
@section('content')
    <x-forms.main back=""
                  title="{{ __('auth.verify.action') }}">
        <form class="d-inline"
              method="POST"
              action="{{ route('verification.send') }}">
            @csrf
            {{__('auth.verify.message')}}
            <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">
                {{ __('auth.verify.button') }}.
            </button>
        </form>
    </x-forms.main>
@endsection
