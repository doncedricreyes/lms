


   


@extends('layouts.user')
<style>
    .demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
    
     
    }
  
    </style>
@section('content')

@if($exams->get(0)->class_subject_teachers->teacher_id == Auth::user()->id || $exams->get(0)->class_subject_teachers->classes->get(0)->adviser_id == auth::user()->id)
<div class="container" id="view">
 
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
     
     
  @foreach($exams as $exam)
            <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title" style=" background-color:#488cc7;">
        <h2 class="mdl-card__title-text" style="font-size:28px; color: white;"> 
     
            {{$exam->title}}
     
                          </h2>
      </div>
            @endforeach
               <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
            <div class="mdl-card__supporting-text">
            @foreach($exams as $exam)
            <h4>Total Score:{{$exam->total_score}}</h4>
<h4>Passing Score:{{$exam->passing_score}}</h4>
<h4>Time: {{$exam->time/60}} minutes</h4>
<h4>Attempt: {{$exam->attempts}}</h4>
<h4>This exam/quiz will open on {{$exam->date_start}} at {{$exam->time_start}}</h4>
<h4>This exam/quiz will closed on {{$exam->date_end}} at {{$exam->time_end}}</h4>

          @endforeach
          <br><br>
        @foreach($exams as $id)
        @if($id->class_subject_teachers->teacher_id == Auth::user()->id)
        <a href="{{route('question.index',$id->id)}}" class="btn btn-primary">Add Questions</a>
        <a href="{{route('questions.show',$id->id)}}" class="btn btn-primary">View Questions</a>
        <a href="/teacher/exams/{{$id->id}}/results?attempt=1" class="btn btn-primary">View Results</a>
        <a href="{{route('exam.edit',$id->id)}}" class="btn btn-primary">Edit</a>
        <a href="/teacher/exam/analysis/{{$id->id}}?attempt=1" class="btn btn-primary">Item Analysis</a>
        @endif

          @endforeach
             </div>
      </div>
    </div>
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  
