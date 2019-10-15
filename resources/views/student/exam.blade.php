


   


@extends('layouts.user')
<style>
    .demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
    
     
    }
  
    </style>
@section('content')

<div class="container" id="view">
 
 <?php  $i = $exam_grades ?>
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title" style=" background-color:#488cc7;">
          <h2 class="mdl-card__title-text" style="font-size:28px; color: white;"> 
              @foreach($exams as $exam)
              {{$exam->title}}
          @endforeach
                            </h2>
        </div>
 
 <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
            <div class="mdl-card__supporting-text">
            @foreach($exams as $exam)
<h3>This exam will open on {{$exam->date_start}}
<h3>This exam will closed on {{$exam->date_end}}
<h3>Total Score: {{$exam->total_score}}</h3>
<h3>Passing Score: {{$exam->passing_score}}</h3>
<h3>Attempts: {{$exam->attempts}}</h3>
<h3>Your Attempt: {{$quiz_attempt->count()}}</h3>
<h3>Time: {{$exam->time/60}} minutes</h3>
          @endforeach
          
            @foreach($exams as $id)
        @if ($id->date_start <= Carbon\Carbon::now('Asia/Manila')) 
        @if ($id->date_end > Carbon\Carbon::now('Asia/Manila')) 
        @if($id->attempts > $exam_grades['attempt'] )
        @if($quiz_latest['id'] == $exam_grades['quiz_attempt_id']) 
        @if($quiz_attempt->count() < $id->attempts)    
        <form action = "{{route('student.store.quiz_start',$id->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field() }}
       
          <input type="submit" id="submit" class="btn btn-primary" value="Attempt Quiz/Exam">     
          @endif
         
    
        @endif
@endif
@endif
@endif
@if($quiz_latest['id'] != $exam_grades['quiz_attempt_id']) 

<a href="{{route('student.show.question',$id->id)}}" class="btn btn-primary">Continue</a>
@endif
        <a href="{{route('student.show.result',$id->id)}}" class="btn btn-primary">View Results</a>
          @endforeach
          
               </div>
          </div>
        </div>
      
</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
