@extends('layouts.user')

@section('content')
    

                   
           
                    <div class="container" id ="add">
                        <form action = "{{route('subject.store')}}" method="post">
                            {{csrf_field() }}
                        <label for="subject">Subject Title:</label>
                        <input type="text" name="subject" id="subject" class="form-control"> 
                        <input type="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>
                        
                    </div>
    @endsection