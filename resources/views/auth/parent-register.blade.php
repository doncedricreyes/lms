@extends('layouts.app')
               

@section('content')




<p class="login-box-msg">Create an account</p>
<form method="POST" action="{{ route('parent.register') }}">
    @csrf
    <div class="form-group has-feedback">
            <input id="name" type="text" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
  <div class="form-group has-feedback">
    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" id="register">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
</form>

<div class="social-auth-links text-center">
  <p>- OR -</p>
  <a href="/student/register" class="btn btn-block btn-social  btn-flat"><i class="fa fa-user-plus"></i> Register as student
    </a>
</div>
<!-- /.social-auth-links -->

<a href="/parent/login" class="text-center">Already a member?</a>
@endsection