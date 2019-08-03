@extends('layouts.user')

@section('content')
    <style>
        #submit{
            position: relative;
            left: 80%;
         
        }
        </style>


                    
                    <div class="container" id ="add">
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
            <legend>Add Teacher</legend>
                        <form action = "{{route('add-teacher.store')}}" method="post">
                            {{csrf_field() }}
                        <label for="name">Teacher's Name:</label>
                        <input type="text" name="name" id="name" class="form-control"> 
                        <label for="username"> Username:</label>
                        <input type="username" name="username" id="username" class="form-control">
                        <label for="password"> Create a password:</label>
                        <input type="password" name="password" title="password" class="form-control">
                        <br>
                        <input type="submit" id="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>

                        
                    </div>
    @endsection
            

    
                
  