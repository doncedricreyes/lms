@extends('layouts.app')
               

@section('content')



<p class="login-box-msg">Parent Reset Password</p>
<form method="POST" action="{{ route('parent.password.email') }}">
    @csrf
  <div class="form-group has-feedback">
    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>

  <div class="row">

    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
    </div>
    <!-- /.col -->
  </div>
</form>


@endsection