


   


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
<style>

  </style>

  @if($assignments->get(0)->class_subject_teachers->teacher_id == auth::user()->id || $assignments->get(0)->class_subject_teachers->classes->get(0)->adviser_id == auth::user()->id)

<div class="container" id="view">
 
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
     
     
  @foreach($assignments as $assignment)
             <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title" style=" background-color:#488cc7;">
        <h2 class="mdl-card__title-text" style="font-size:28px; color: white;"> 
            {{$assignment->title}}
        
                          </h2>
      </div>
            @endforeach
             <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
                <div class="mdl-card__supporting-text">
            @foreach($assignments as $assignment)
            <p class="lead">{{$assignment->description}}</p>
<p>This assignment will open on {{$assignment->date_start}} </p>
<p>This assignment will closed on {{$assignment->date_end}} </p>
<br><br>
          @endforeach
        @foreach($assignments as $id)
   <div id="button">
    @if($assignments->get(0)->class_subject_teachers->teacher_id == Auth::user()->id)
          <a href="{{route('assignment.result',$id->id)}}" class="btn btn-primary">View Results</a>
        <a href="{{route('assignment.edit',$id->id)}}"   class="btn btn-primary">Edit</a>
        @endif
   </div>
          @endforeach
            </div>
      </div>
    </div>
</div>

@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  
