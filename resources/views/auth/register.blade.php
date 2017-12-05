@extends('layouts.auth')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signup m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('backend/app/media/img//bg/bg-3.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ asset('backend/app/media/img//logos/logo-1.png') }}">
                    </a>
                </div>
                <div class="m-login__signup">
        <div class="m-login__head">
            <h3 class="m-login__title">
                Register
            </h3>
            <div class="m-login__desc">
                Enter your details to create your account:
            </div>
        </div>
        <form class="m-login__form m-form" action="{{ route('register') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group m-form__group">
                <input class="form-control m-input{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       type="text" placeholder="Fullname" name="name"
                       value="{{ old('name') }}" autofocus required>

                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       type="email" placeholder="Email" name="email"
                       value="{{ old('email') }}"
                       autocomplete="off" required>

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       type="password" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="password_confirmation">
            </div>

            {{--<div class="row form-group m-form__group m-login__form-sub">
                <div class="col m--align-left">
                    <label class="m-checkbox m-checkbox--focus">
                        <input type="checkbox" name="agree">
                        I Agree the
                        <a href="#" class="m-link m-link--focus">
                            terms and conditions
                        </a>
                        .
                        <span></span>
                    </label>
                    <span class="m-form__help"></span>
                </div>
            </div>--}}

            <div class="m-login__form-action">
                <button type="submit" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                    Register
                </button>
                &nbsp;&nbsp;
                <a href="{{ route('login') }}" id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                    Back to login page
                </a>
            </div>
        </form>
    </div>
            </div>
        </div>
    </div>
@endsection
