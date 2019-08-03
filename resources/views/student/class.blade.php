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
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
   <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text"> 
            <h2>Section: {{$class_subject_teachers->classes->first()->year}}-{{$class_subject_teachers->classes->first()->section}}
        </h2>
                          </h2>
      </div>
  
      <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
        <p>Adviser:     <a href="teachers/profile/{{$class_subject_teachers->classes->first()->teachers->first()->id}}" >  {{$class_subject_teachers->classes->first()->teachers->first()->name}}</a></p>
           <p>Section Name: {{$class_subject_teachers->classes->first()->section_name}}</p>
        <p>School year: {{$class_subject_teachers->classes->first()->school_year}}</p>
         <p>Time: {{$class_subject_teachers->classes->first()->time}}</p>
         <p>Room: {{$class_subject_teachers->classes->first()->room}}</p>
     
        
        </div>
      </div>
    </div>
    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
      <div class="mdl-tabs__tab-bar">
          <a href="#announcements-panel" class="mdl-tabs__tab is-active">Announcements</a>
        <a href="#subjects-panel" class="mdl-tabs__tab">Subjects</a>
        <a href="#classlist-panel" class="mdl-tabs__tab">Class List</a>
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
         <h5>Schedule: {{$subject->class_subject_teachers->get(0)->schedule}}</h5>
       </div>
     </div>
   </div>
<br><br>
@endforeach 
   </div>

   <div class="mdl-tabs__panel" id="classlist-panel">
                   
         <div class="row">
          <div class="col-lg-12 col-md-offset-0">
          <div class="panel panel-default">
              <div class="panel-heading">Students</div>

              <div class="panel-body">    
                      <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>View Profile</th>
                              <th>Message</th>
                  
                              
             
                          </tr>
                      </thead>
                      <tbody>
                         
           
                        @foreach($students as $student)
              <tr>
                  <td>{{$student->students->get(0)->name}}</td>
                  <td><a href="/student/profile/{{$student->student_id}}"><button class="btn btn-primary btn-xs"><i class="material-icons">person </i></button></a></td>
                  <td><a href="{{$student->student_id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></td></a>
                  
              </tr>
                              @endforeach
                      </tbody>
                  </table>
                
              </div>
          </div>
      </div>

      
  </div>




 
 
    
    
 
         </div>














 
   
</div>
    @endsection