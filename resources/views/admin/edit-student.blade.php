@extends('layouts.user')

@section('content')
    <style>
        #submit{
            position: relative;
            float:right;
         
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
            <legend>Edit Student</legend>
            @foreach($students as $id)
            <form action = "{{route('add-student.update',$id->id)}}" method="post" enctype="multipart/form-data">                   
              {{csrf_field() }}
              <input name="_method" type="hidden" value="PUT">
              @endforeach
                        <label for="name">Student's Name:</label>
                        <input type="text" name="name" id="name" value="{{$students->get(0)->name}}" class="form-control"> 
                        <label for="year">Year:</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{$class_students->get(0)['year']}}"> 
                        <label for="section">Section:</label>
                        <input type="text" name="section" id="section" class="form-control" value="{{$class_students->get(0)['section']}}">
                        <label for="username"> Username:</label>
                        <input type="text" name="username" id="username" value="{{$students->get(0)->username}}" class="form-control">
                        <label for="password"> Create a password:</label>
                        <input type="password" name="password" title="password"  class="form-control">
                        <br>
                        <input type="submit" id="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>

                        
                    </div>
    @endsection
            
            

    
                
  
