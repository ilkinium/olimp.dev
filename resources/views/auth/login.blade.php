@extends('layouts.auth')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('backend/app/media/img//bg/bg-3.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ asset('backend/app/media/img//logos/logo-1.png') }}">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Sign In To Admin
                        </h3>
                    </div>
                    <form class="m-login__form m-form" action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group m-form__group">
                            <input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   type="email"
                                   id="email"
                                   placeholder="Email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   autocomplete="off" required>

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

                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--focus">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember me
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" type="submit"
                                    class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
                @include('auth.passwords.email')
            </div>
        </div>
    </div>

@endsection