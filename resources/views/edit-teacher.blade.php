@extends('layouts.user')

@section('content')
        <style>
        #submit{
            position: relative;
            float: right;
         
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

                   
                    
                    <div class="container" id ="add">
                        <form action = "{{route('add-teacher.store')}}" method="post">
                            {{csrf_field() }}
                        <label for="teacher_name">Teacher's Name:</label>
                        <input type="text" name="teacher_name" id="teacher_name" class="form-control"> 
                        <label for="email"> E-mail Address:</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <label for="password"> Create a password:</label>
                        <input type="password" name="password" title="password" class="form-control">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>
                        
                    </div>
    @endsection
            

    
                
  
