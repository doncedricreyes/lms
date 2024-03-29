@extends('layouts.user')

@section('content')
<style>
   #submit{
        position: relative;
        float: right;
    }
    #view{
        position: relative;
        right: 10%;
        width:70%;
    }
    </style>
           <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
                @endif
<div class="container" id="view">
 
        
    <form action="{{route('teacher.edit.email')}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
<div class="form-group">
    <label>Email:</label>
    <input class="form-control" type="email" id="email" name="email" value="{{$teacher->get(0)->email}}">
  </div>

<div class="col-lg-12 p-t-20">
    <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Change Email
               </button>
    </div>
    </form>
<br><br><br>
<form action="{{route('teacher.edit.pass')}}" method="post" enctype="multipart/form-data">
    {{csrf_field() }}
       <div class="form-group has-feedback">
    <input id="oldpassword" type="password" placeholder="Password" class="form-control" name="oldpassword" required >
    </div>
    <div class="form-group has-feedback">
            <input id="password" type="password" placeholder="New Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
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
