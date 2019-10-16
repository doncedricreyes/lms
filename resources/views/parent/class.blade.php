@extends('layouts.user')

@section('content')

<style>
   .demo-card-wide.mdl-card {
     width: 100%;
   }
   .demo-card-wide {
    
     height: 200%;
    
   }
 
   </style>

<div class="container" id ="view">
    @foreach($class_students as $class_student)
   <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title" style=" background-color:#488cc7;">
        <h2 class="mdl-card__title-text"> 
           <a href="classes/{{$class_student->student_id}}" style="font-size:28px; color:white;"> <h1>
         {{$class_student->students->get(0)->name}}</h1></a>
                          </h2>
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <h4>Adviser: <a href="/parent/teachers/profile/{{$class_student->class_subject_teachers->get(0)->teachers->get(0)->id}}" >{{$class_student->class_subject_teachers->get(0)->classes->get(0)->teachers->get(0)->name}}</a></h4>
                <h4>Year and Section: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section}}</h4>
                <h4>Section name: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->section_name}}</h4>
              
                <h4>School Year: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->school_year}}</h4>
                <h4>Time: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->time}}</h4>
                <h4>Room: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->room}}</h4>
        
        </div>
      </div>
    </div>
    <br><br><br>
@endforeach
</div>
    @endsection
