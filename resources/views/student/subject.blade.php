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
                       <h3>{{$students->first()->name}}</h3>
                                       </h2>
                    </div>
                
                    <div class="mdl-card__actions mdl-card--border">
                      <div class="mdl-card__supporting-text">
                          @foreach($class_subject_teachers as $class_subject_teacher)
                          @if(Auth::user()->role == 'student')
                          <p>Teacher: <a href="/student/teachers/profile/{{$class_subject_teachers->get(0)->teachers->get(0)->id}}" > {{$class_subject_teacher->teachers->get(0)->name}}</a></p>
                          @endif  
                          @if(Auth::user()->role == 'parent')
                          <p>Teacher: <a href="/parent/teachers/profile/{{$class_subject_teachers->get(0)->teachers->get(0)->id}}" > {{$class_subject_teacher->teachers->get(0)->name}}</a></p>
                          @endif 
                          <p>Subject:  {{$class_subject_teacher->subjects->get(0)->title}}</p>
                          <p>Year and Section: {{$class_subject_teacher->classes->get(0)->year}}-{{$class_subject_teacher->classes->get(0)->section}}</p>
                          <p>Section Name: {{$class_subject_teacher->classes->get(0)->section_name}}</p>
                          <p>Schedule: {{$class_subject_teacher->schedule  }}</p>
                         
                          @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                      <div class="mdl-tabs__tab-bar">
                          <a href="#announcements-panel" class="mdl-tabs__tab is-active">Announcements</a>
                        <a href="#resources-panel" class="mdl-tabs__tab ">Resources</a>
                        <a href="#classlist-panel" class="mdl-tabs__tab">Class List</a>
                        <a href="#grades-panel" class="mdl-tabs__tab">Grades</a>
                      </div>

                      @foreach($class_subject_teachers as $id)
                      <form action="{{route('student.show.subject',$id->id)}}" method="GET">
                
                          <div class="form-group">
                              <label for="quarter">Quarter:</label>
                              <select  name="quarter" id="quarter" onchange="this.form.submit()">
                                  <option disabled selected value> -- select quarter -- </option>
                                <option value="1">1st Quarter</option>
                                <option value="2">2nd Quarter</option>
                                <option value="3">3rd Quarter</option>
                                <option value="4">4th Quarter</option>
                              </select>
                            </div>  
                        </form>
                        @endforeach
                    <br><br>


                    <div class="mdl-tabs__panel is-active" id="announcements-panel">
                        <br><br>
                    
              @foreach($subject_announcements as $announcement)
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

                      <div class="mdl-tabs__panel" id="resources-panel">
                      <legend>Lectures</legend>
                      @foreach($lectures as $lecture)
                      <a href="/public/storage/lectures/{{$lecture->file_name}}" download="{{$lecture->file_name}}"><div class="icon material-icons">file_copy</div>{{$lecture->file_title}}</a>
                      <br>
                        @endforeach
                      <br><br>
                      <legend>Assignments</legend>
                      @foreach($assignments as $assignment)
                      <a href="{{route('student.assignment.show', $assignment->id)}}"><div class="icon material-icons">assignment</div>{{$assignment->title}}</a><br>
                          @endforeach
<br><br>

                      <legend>Quizzes and Exams</legend>
                      @foreach($exams as $exam)
                    <p> <a href="{{route('student.show.exam', $exam->id)}}" ><div class="icon material-icons">label_important</div>{{$exam->title}} </a></p>
                      @endforeach
              <br><br>
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
                                             <th>Send Message</th>
                                             
                            
                                         </tr>
                                     </thead>
                                     <tbody>
                                        
                          
                                       @foreach($class_students as $class_student)
                             <tr>
                                 <td>{{$class_student->students->get(0)->name}}</td>
                                 <td><a href="/student/profile/{{$class_student->student_id}}"><button class="btn btn-primary btn-xs"><i class="material-icons">person </i></button></a></td>
                                <td><a href="/student/{{$class_student->students->get(0)->id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></a></td>
                                 
                             </tr>
                                             @endforeach
                                     </tbody>
                                 </table>
                               
                             </div>
                         </div>
                     </div>
                 </div>
                          
                         </div>




                          <div class="mdl-tabs__panel" id="grades-panel">
                          
                          <div class="row">
                              <div class="col-lg-12 col-md-offset-0">
                              <div class="panel panel-default">
                                  <div class="panel-heading">Quizzes</div>
                        
                                  <div class="panel-body">    
                                          <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                                          <thead>
                                              <tr>

                                                
                                                  <th>Quiz title</th>
                                                  <th>Attempt</th>
                                                  <th>Score</th>
                                              </tr >
                                              
                                          </thead>
                                          <tbody>
                                             
                               
                                        
                                  <tr>

                                        @foreach($subject_grade as $grade)
                                        <td>{{$grade->exams->get(0)->title}}</td>
                                        <td>{{$grade->attempt}}</td>
                                      <td>{{$grade->grade}}/{{$grade->exams->get(0)->total_score}}</td>
                                      
                                  </tr>
                                  @endforeach           
                                          </tbody>
                                      </table>
                                    
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <div class="panel-heading">Assignments</div>
                  
                            <div class="panel-body">    
                                    <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                                    <thead>
                                        <tr>
 @foreach($student_assignment as $assign)
                                            <th>{{$assign->assignments->title}}</th>
                                            @endforeach
                                        </tr >
                                        
                                    </thead>
                                    <tbody>
                                       
                         
                                  
                            <tr>

                                  @foreach($student_assignment as $assign)
                                <td>{{$assign->grade}}</td>
                                @endforeach
                                         
                            </tr>
                                           
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
                    </div>
                </div>
                      </div>
                    </div>
</div>

                      
                </div>
@endsection
