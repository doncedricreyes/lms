@extends('layouts.user')

@section('content')
    

                   
                    
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
            

    
                
  