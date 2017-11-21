<div class="m-login__forget-password">
    <div class="m-login__head">
        <h3 class="m-login__title">
            Forgotten Password ?
        </h3>
        <div class="m-login__desc">
            Enter your email to reset your password:
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="m-login__form m-form"  method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group m-form__group">
            <input class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   type="email" placeholder="Email"
                   name="email" id="m_email"
                   autocomplete="off" required>

            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif

        </div>
        <div class="m-login__form-action">
            <button type="submit" id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">
                Send Password Reset Link
            </button>
            &nbsp;&nbsp;
            <a href="{{ route('login') }}" id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                Back to Login page
            </a>
        </div>
    </form>
</div>