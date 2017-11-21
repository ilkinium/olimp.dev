@extends('layouts.auth')

@section('content')
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">
                Reset Password
            </h3>
        </div>
        <form class="m-login__form m-form" action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group m-form__group">
                <input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                       type="email"
                       id="email"
                       placeholder="Email"
                       name="email"
                       value="{{ old('email') }}"
                       autocomplete="off" required autofocus>

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input m-login__form-input--last {{ $errors->has('password') ? ' is-invalid' : '' }}"
                       type="password"
                       id="password"
                       placeholder="Password"
                       name="password" required>

                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input m-login__form-input--last {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                       type="password"
                       id="password-confirm"
                       placeholder="Confirm Password"
                       name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </div>
                @endif
            </div>

            <div class="m-login__form-action">
                <button id="m_login_signin_submit" type="submit"
                        class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@endsection
