
@extends('layouts.app')
               

@section('content')



<p class="login-box-msg">Teacher Reset Password</p>
<form method="POST" action="{{ route('teacher.password.request') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

  <div class="form-group has-feedback">
    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
    <!-- /.col -->
    <div class="form-group has-feedback">
            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
       
      </div>
      <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </div>
    <!-- /.col -->
</form>


@endsection