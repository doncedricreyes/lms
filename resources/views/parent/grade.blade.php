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
    @foreach($students as $class_student)
   <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text"> 
           <a href="grades/{{$class_student->student_id}}"> <h1>
         {{$class_student->students->get(0)->name}}</h1></a>
                          </h2>
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <h4>Adviser: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->teachers->get(0)->name}}</h4>
                <h4>Year and Section: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section}}</h4>
                <h4>Section name: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->section_name}}</h4>
              
                <h4>School Year: {{$class_student->class_subject_teachers->get(0)->classes->get(0)->school_year}}</h4>
        
        </div>
      </div>
    </div>
    <br><br><br>
@endforeach
</div>
    @endsection






            

    
                
  