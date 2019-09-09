


@extends('layouts.user')

@section('content')

            <div class="container">

                    <form action="{{route('teacher.grade.show',[$class_students->get(0)->class_subject_teacher_id,$class_students->get(0)->student_id])}}" method="GET">
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
                        <br><br>

                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>Quizzes</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                     
                                        <th>Quiz Title</th>
                                        <th>Attempt</th>
                                        <th>Grade</th>
                                        <th>Passing Score</th>
                                       
                                   </thead>
                    <tbody>
                  
                
                                
                       <tr>
                            @foreach($subject_grade as $row)
                                <td>{{$row->quiz_attempt->get(0)->exams->get(0)->title}}</td>
                                <td>{{$row->quiz_attempt->get(0)->attempt}}</td>
                                <td>{{$row->grade}}</td>    
                                <td>{{$row->quiz_attempt->get(0)->exams->get(0)->passing_score}}</td>
                                
                       </tr>                    
                       @endforeach 
                     
                            
                    
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>

                    </div>

<br><br>
                    <div class="row">
                        
                        
                            <div class="col-md-12">
                            <legend>Assignments</legend>
                
                            <div class="table-responsive">
                    
                                    
                                  <table id="mytable" class="table table-bordred table-striped">
                                    
                                       <thead>  
                                            <th>Assignment Title</th>
                                            <th>Grade</th>
                                           
                                       </thead>
                        <tbody>
                      
                    
                                    
                           <tr>
                                @foreach($assignment as $row)
                                <td>{{$row->assignments->title}}</td>
                                    <td>{{$row->grade}}</td>    
                                   
                           </tr>                    
                           @endforeach  
                         
                                
                        
                       
                        
                        </tbody>
                            
                    </table>
        </div>
        </div>
    
                        </div>
            </div>

            


@endsection




            

    
                
  
