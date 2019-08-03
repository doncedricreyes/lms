@extends('layouts.user')

@section('content')
<style>
    #submit{
        position: relative;
        left: 80%;
     
    }
    </style>
@if(Auth::user()->role == 'superadmin')
    <div class="container" id="view">
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
            <form action = "{{route('admin.create')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field() }}
<div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
      </div>
      <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
              </div>
              <div class="form-group">
                    
                  <input type="submit" id="submit" class="btn btn-primary" value="Submit Information">
                  </div>
    </div>
@endif
@endsection