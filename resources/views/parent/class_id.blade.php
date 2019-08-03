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
   <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text"> 
         <h3> Name of Student: <a href="/parent/students/profile/{{$class_students->get(0)->student_id}}" > {{$class_students->get(0)->students->get(0)->name}}</h3></a>
                          </h2>
      </div>
  
      <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <a href="/parent/teachers/profile/{{$class_subject_teachers->classes->first()->teachers->first()->id}}" >  <p>Adviser: {{$class_subject_teachers->classes->first()->teachers->first()->name}}</p></a>
          <p>Section: {{$class_subject_teachers->classes->first()->year}}-{{$class_subject_teachers->classes->first()->section}}</p>
          <p>Section Name:  {{$class_subject_teachers->classes->first()->section_name}}</p>
        <p>School year: {{$class_subject_teachers->classes->first()->school_year}}</p>
     
        
        </div>
      </div>
    </div>
    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
      <div class="mdl-tabs__tab-bar">
          <a href="#announcements-panel" class="mdl-tabs__tab is-active">Announcements</a>
        <a href="#subjects-panel" class="mdl-tabs__tab">Subjects</a>
      </div>
      
      <div class="mdl-tabs__panel is-active" id="announcements-panel">
          <br><br>
      
<br><br>
@foreach($class_announcements as $announcement)
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
      <h2 class="mdl-card__title-text">{{$announcement->title}}</h2>
    </div>

    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
     <p> {{$announcement->body}}</p>
      </a>
    </div>
  
  </div>
  <br><br>
  @endforeach
        
  </div>


   <div class="mdl-tabs__panel" id="subjects-panel">
      
      <div class="card-head">
         <br><br><br>   
         <legend>Subjects</legend>
   
      </div>
      @foreach($class_students as $class_student)
      <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text"> 
              <a href="{{$class_student->student_id}}/subjects/{{$class_student->class_subject_teacher_id}}" ><h3>{{$class_student->class_subject_teachers->get(0)->subjects->get(0)->title}}</h3></a>
                           </h2>
        </div>
    
        <div class="mdl-card__actions mdl-card--border">
          <div class="mdl-card__supporting-text">
              <a href="/parent/teachers/profile/{{$class_student->class_subject_teachers->get(0)->teachers->get(0)->id}}" >  <h4> Teacher: {{$class_student->class_subject_teachers->get(0)->teachers->get(0)->name}}</h4></a>
            <h5>Schedule: {{$class_student->class_subject_teachers->get(0)->schedule}}</h5>
          </div>
        </div>
      </div>
   <br><br>
   @endforeach 
      </div>

   
</div>
    @endsection