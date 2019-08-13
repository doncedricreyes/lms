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
            <legend>Edit Teacher</legend>
            @foreach($teachers as $id)
            <form action = "{{route('add-teacher.update',$id->id)}}" method="post" enctype="multipart/form-data">                   
              {{csrf_field() }}
              <input name="_method" type="hidden" value="PUT">
              @endforeach
                        <label for="teacher_name">Teacher's Name:</label>
                        <input type="text" name="teacher_name" id="teacher_name" value="{{$teachers->get(0)->name}}" class="form-control"> 
                        <label for="email"> E-mail Address:</label>
                        <input type="email" name="email" id="email" value="{{$teachers->get(0)->email}}" class="form-control">
                        <label for="password"> Create a password:</label>
                        <input type="password" name="password" title="password"  class="form-control">
                        <br>
                        <input type="submit" id="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>

                        
                    </div>
    @endsection
            

    
                
  