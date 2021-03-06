@extends('layouts.auth')

@section('auth')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card-group">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center d-lg-none">
                    <img src="svg/modulr.svg" class="mb-5" width="150" alt="Modulr Logo">
                </div>
                <h1>{{ __('Login') }}</h1>
                <p class="text-muted">Sign In to your account</p>

                <form method="POST" action="{{ route('login.index') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                        </svg>
                      </span>
                        </div>
                        <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                         name="login" value="{{ old('username') ?: old('email') }}" placeholder="{{ __('Username') }}" required autofocus>

                    @if ($errors->has('username') || $errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                        </svg>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary px4">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-8 text-right">

                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="card text-white bg-primary py-5 d-md-down-none">
            <div class="card-body text-center">
                <div>
                <img src= "{{ ('assets/img/unand.png') }}" width="100" height="150" class="img-fluid" alt="Responsive image">
                    <h2>{{ __('SIAMI') }}</h2>
                    <p>Sistem Informasi Audit Mutu Internal Universitas Andalas</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection