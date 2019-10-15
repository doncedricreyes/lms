


   


@extends('layouts.user')
<style>
    .demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
    
     
    }
    #submit{
      float:right;
    }
    </style>
@section('content')



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
     
@foreach($assignments as $assignment)
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title" style=" background-color:#488cc7;">
      <h2 class="mdl-card__title-text" style="font-size:28px; color: white;"> 
          {{$assignment->title}}
      
                        </h2>
    </div>

    <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
      <div class="mdl-card__supporting-text">
      <p style="font-size:16px;">{{$assignment->description}}</p>
      <h4>Submission starts: {{$assignment->date_start}} </h4>
      <h4>Submission deadline: {{$assignment->date_end}} </h4>
      @endforeach
      @foreach($assignments as $id)
      @if ($id->date_start <= Carbon\Carbon::now('Asia/Manila') && $student_assignments->count() == 0) 
      @if ($id->date_end > Carbon\Carbon::now('Asia/Manila') && $student_assignments->count() == 0) 
      <button type="button" class="btn btn-primary" id="submit" data-toggle="modal" data-target="#exampleModal">
          Submit Assignment
        </button>          
      @else <h3>Assignment is closed</h3>
      @endif
      @endif
    @endforeach
      </div>
    </div>
  </div>
     
  
        
                
        


          
          @foreach($assignments as $id)
  <form action = "{{route('student.assignment.store',$id->id)}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
      @endforeach
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Submit Assignment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label for="file">Filename:</label>
                <input class="mdl-textfield__input" type="text" name="file_title" id="file">
                <input class="mdl-textfield__input" type="file" name="file" id="file" >
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Submit Information">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
