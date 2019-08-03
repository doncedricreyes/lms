@extends('layouts.user')

@section('content')
<style>
    #submit{
        position: absolute;
        right: 5%;
        top: 100%;
    }
    </style>
<div class="container" id="view">
        <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
        
    <form action="{{route('parent.edit.email')}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
<div class="form-group">
    <label>Email:</label>
    <input class="form-control" type="email" id="email" name="email" value="{{$parent->get(0)->email}}">
  </div>

<div class="col-lg-12 p-t-20">
    <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Change Email
               </button>
    </div>
    </form>
<br><br><br>
<form action="{{route('parent.edit.pass')}}" method="post" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group has-feedback">
            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
 
          </div>
          <div class="form-group has-feedback">
                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
          
              </div>
              <div class="form-group has-feedback">
              <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Change Password
               </button>
              </div>
</form>
    </div>



@endsection