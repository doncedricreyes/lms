


   


@extends('layouts.user')

@section('content')
<style>

  </style>

  @if($assignments->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
 
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
     
     
  @foreach($assignments as $assignment)
            <legend><h1>{{$assignment->title}}</h1></legend>
            @endforeach
            @foreach($assignments as $assignment)
            <p class="lead">{{$assignment->description}}</p>
<p>This assignment will open on {{$assignment->date_start}} </p>
<p>This assignment will closed on {{$assignment->date_end}} </p>
<br><br>
          @endforeach
        @foreach($assignments as $id)
   <div id="button">
  
          <a href="{{route('assignment.result',$id->id)}}" class="btn btn-primary">View Results</a>
          @if($assignments->get(0)->class_subject_teachers->teacher_id == Auth::user()->id)
        <a href="{{route('assignment.edit',$id->id)}}"   class="btn btn-primary">Edit</a>
        @endif
   </div>
          @endforeach
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  