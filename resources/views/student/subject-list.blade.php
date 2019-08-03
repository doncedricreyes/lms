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


         <legend><h1>Subjects</h1></legend>
                  @foreach($class_students as $subject)
                  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                      <h2 class="mdl-card__title-text"> 
                        <a href="class/{{$subject->class_subject_teacher_id}}" ><h3>{{$subject->class_subject_teachers->get(0)->subjects->get(0)->title}}</h3></a>
                                       </h2>
                    </div>
                
                    <div class="mdl-card__actions mdl-card--border">
                      <div class="mdl-card__supporting-text">
                            <a href="teachers/profile/{{$subject->class_subject_teachers->get(0)->teachers->get(0)->id}}" > <h5>Teacher: {{$subject->class_subject_teachers->get(0)->teachers->get(0)->name}}</h5></a>
                        <h5>Year and Section: {{$subject->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$subject->class_subject_teachers->get(0)->classes->get(0)->section}}</h5>
                        <h5>Section Name: {{$subject->class_subject_teachers->get(0)->classes->get(0)->section_name}} </h5>
                        <h5>School year: {{$subject->class_subject_teachers->get(0)->classes->get(0)->school_year}}</h5>
                        <h5>Schedule: {{$subject->class_subject_teachers->get(0)->schedule}}</h5>
                      </div>
                    </div>
                  </div>
               <br><br>
                      @endforeach
                </div>
@endsection
