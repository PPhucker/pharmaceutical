@extends('layouts.auth')
@section('auth')
    <h1 class="text-primary">
        {{ __('auth.passwords.email') }}
    </h1>
    <form method="POST"
          action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            @if (session('status'))
                <div class="alert alert-success"
                     role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <input id="email"
                   type="email"
                   class="form-control form-control-lg text-primary
                       @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   placeholder="E-mail">
            @error('email')
            <span class="invalid-feedback"
                  role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="row mb-0">
            <div class="col-2">
                <button type="submit"
                        class="btn btn-primary w-100">
                    {{__('OK')}}
                </button>
            </div>
        </div>
    </form>
@endsection

