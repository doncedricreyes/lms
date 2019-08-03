@extends('layouts.teacher')

@section('content')

<div class="container" id ="view">


      
                
         
  <form action = "{{route('lecture.store')}}" method="post">
      {{csrf_field() }}
  
      <div class="col-lg-6 p-t-20">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label for="file_title">File Title:</label>
                    <input class="mdl-textfield__input" type="text" name="file_title" id="file_title">
            </div>
        </div>

        
           
        <div class="col-lg-6 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">               
                <input class="mdl-textfield__input" type="file" name="file_name" id="file_name" >
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
   
        
                      
                </div>
@endsection
