@extends('layouts.auth')
@section('auth')
    <h1 class="text-primary mb-3">
        {{ __('auth.passwords.email') }}
    </h1>
    @if (session('status'))
        <div class="alert alert-success"
             role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST"
          action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
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
        <button type="submit"
                class="btn btn-primary">
           OK
        </button>
    </form>
@endsection

