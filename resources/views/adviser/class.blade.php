@extends('layouts.user')

@section('content')

<style>
    .demo-card-wide.mdl-card {
      width: 100%;
    }
    .demo-card-wide {
     
      height: 200%;
     
    }
    #delete{
position: absolute;
right: 2%;
    }

.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
.demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
     
    }
    #searchbar{
     
     display: block;
   text-align: center;
   }
  #search{
    position: relative;
    left: 37%;
  }
        .mdl-data-table th, td{
 text-align: left !important;
 font-size: 16px;
}
#head {
 background-color:#488cc7;
 text-align: center !important;
 font-size: 24px;
 color: white;
}
#table{
 background-color:snow;
 position: relative;
 width:90%;
 left: 5%;
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
      <div class="mdl-card__title" style=" background-color:#488cc7;">
        <h2 class="mdl-card__title-text"> 
            <h2 style="font-size:28px; color: white;">Section: {{$classes->get(0)['year']}}-{{$classes->get(0)['section']}}
           </h2>
                          </h2>
      </div>
  
      <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
        <div class="mdl-card__supporting-text">
            <p style="font-size:16px;">Adviser:   <a href="profile/{{auth::user()->id}}" >{{auth::user()->name}}</a></p>
          <p style="font-size:16px;">Section Name:  {{$classes->get(0)['section_name']}}</p>
        <p style="font-size:16px;">School year: {{$classes->get(0)['school_year']}}</p>
        <p style="font-size:16px;">Time: {{$classes->get(0)['time']}}</p>
        <p style="font-size:16px;">Room: {{$classes->get(0)['room']}}</p>
     
        
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
  
           <legend style="position:relative; left:5%;"><a href="{{route('announcement.create',$classes->get(0)['id'])}}" class="btn btn-primary">Create Announcement</a></legend>  
<br><br>
@foreach($class_announcements as $announcement)
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text"><a href="class/announcements/{{$announcement->id}}/edit">{{$announcement->title}}</a></h2>
          <form action="{{route('announcement.destroy',$announcement->id)}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
<button id="delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs" value="submit" type="submit">Delete<span class="glyphicon glyphicon-trash"></span></button>
          </form>       
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
               
           
              </div>
              @foreach($class_subject_teachers as $subject)
              <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title" style=" background-color:#488cc7;">
                  <h2 class="mdl-card__title-text"> 
                    <a href="subjects/{{$subject->id}}" ><h3 style="font-size:28px; color: white;">{{$subject->subjects->get(0)->title}}</h3></a>
                                   </h2>
                </div>
            
                <div class="mdl-card__actions mdl-card--border">
                  <div class="mdl-card__supporting-text">
                      <a href="profile/{{$subject->teachers->get(0)->id}}" > <h5 style="font-size:16px;">Teacher: {{$subject->teachers->get(0)->name}}</h5></a>
                    <h5 style="font-size:16px;">Schedule: {{$subject->schedule}}</h5>
                  </div>
                </div>
              </div>
           <br><br>
           @endforeach 
              </div>

   <div class="card-head">
      <br><br><br>   
     
   </div>



   <div class="mdl-tabs__panel" id="classlist-panel">
                   
         <div class="row">
          <div class="col-lg-12 col-md-offset-0">
          <div class="panel panel-default">
              <div class="panel-heading" id="head">Students</div>

              <div class="panel-body">    
                  <div class = "table-responsive">
                      <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Email</th>
                  <th>View Grades</th>
                  <th> View Profile</th>
                              <th> Message Student </th>
             <th>Message Parent
                          </tr>
                      </thead>
                      <tbody>
                         
           
                        @foreach($class_students as $class_student)
              <tr>
                  <td>{{$class_student->students->get(0)->name}}</td>
                  <td>{{$class_student->students->get(0)->email}}</td>
                  <td> <a href="class/grades/{{$class_student->students->get(0)->id}}"><button type="button" class="btn btn-primary btn-xs"><span class="material-icons">
                      search</span></button></a></td>
                      <td><a href="student/profile/{{$class_student->student_id}}"><button class="btn btn-primary btn-xs"><i class="material-icons">person </i></button></a></td>
                      <td><a href="student/{{$class_student->student_id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></td></a>
                      @empty(!$class_student->parent_id)
                      <td><a href="/teacher/parent/{{$class_student->parent_id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></td></a>
                      @endempty
                      @empty($class_student->parent_id)
                      <td>Parent/Guardian is not yet registered!</td>
                      @endempty
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

      
   
</div>
    @endsection
