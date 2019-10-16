@extends('layouts.user')

@section('content')

<style>
  

.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
.demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
     
    }

    </style>

<div class="container" id ="view">
   <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title" style=" background-color:#488cc7;">
        <h2 class="mdl-card__title-text"> 
         <h3><a style="font-size:28px; color: white;"  href="/parent/students/profile/{{$class_students->get(0)->student_id}}" > {{$class_students->get(0)->students->get(0)->name}}</h3></a>
                          </h2>
      </div>
  
      <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
        <div class="mdl-card__supporting-text">
            <a href="/parent/teachers/profile/{{$class_subject_teachers->classes->first()->teachers->first()->id}}" >  <p style="font-size:16px;">Adviser: {{$class_subject_teachers->classes->first()->teachers->first()->name}}</p></a>
          <p style="font-size:16px;">Section: {{$class_subject_teachers->classes->first()->year}}-{{$class_subject_teachers->classes->first()->section}}</p>
          <p style="font-size:16px;">Section Name:  {{$class_subject_teachers->classes->first()->section_name}}</p>
        <p style="font-size:16px;">School year: {{$class_subject_teachers->classes->first()->school_year}}</p>
     
        
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
    <div class="mdl-card__title" style=" background-color:#488cc7;">
      <h2 class="mdl-card__title-text" style="font-size:28px; color: white;">{{$announcement->title}}</h2>
    </div>

    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
     <p style="font-size:16px;"> {{$announcement->body}}</p>
      </a>
    </div>
  
  </div>
  <br><br>
  @endforeach
        
  </div>


   <div class="mdl-tabs__panel" id="subjects-panel">
      
      <div class="card-head">
         <br><br><br>   
        
   
      </div>
      @foreach($class_students as $class_student)
      <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title" style=" background-color:#488cc7;">
          <h2 class="mdl-card__title-text"> 
              <a href="{{$class_student->student_id}}/subjects/{{$class_student->class_subject_teacher_id}}" ><h3 style="font-size:28px; color: white;">{{$class_student->class_subject_teachers->get(0)->subjects->get(0)->title}}</h3></a>
                           </h2>
        </div>
    
        <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
          <div class="mdl-card__supporting-text">
              <a href="/parent/teachers/profile/{{$class_student->class_subject_teachers->get(0)->teachers->get(0)->id}}" >  <h4 style="font-size:16px;"> Teacher: {{$class_student->class_subject_teachers->get(0)->teachers->get(0)->name}}</h4></a>
            <h5 style="font-size:16px;">Schedule: {{$class_student->class_subject_teachers->get(0)->schedule}}</h5>
          </div>
        </div>
      </div>
   <br><br>
   @endforeach 
      </div>

   
</div>
    @endsection
