


@extends('layouts.user')

@section('content')

    <div class="container" id="view">
          
        <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
                <div class="container">
                    <div class="row">
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                                <legend>{{$parents->get(0)->name}}</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name of Student</th>
                                        <th>Year and Section</th>
                                        <th>Section Name</th>
                                        <th>School Year</th>
                                        <th>Remove</th>
                                        <th> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Add Students</th>
                                   
                                     
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($class_students as $row)
                            <tr>
                                <td>{{$row->students->get(0)->name}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$row->class_subject_teachers->get(0)->classes->get(0)->section}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->section_name}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->school_year}}</td>
                                 
                                <form action="{{route('enrollment.destroy',[$row->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PUT">
                                        <input type="hidden" value={{$row->student_id}} name="student" id ="student">
                    <td><button class="btn btn-danger btn-xs" name="submit"  type="submit" ><span class="glyphicon glyphicon-trash"></span></button></td>
                    </form>
                            
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>












    
                    </div>
                    
                    <form action = "{{route('parent.enrollment.store',$parents->get(0)['id'])}}" method="post" enctype="multipart/form-data">
                                          
                        {{csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                
                <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                
                
                <label for="name">Student Name:</label>
                <input class="mdl-textfield__input" type="text" name="name" id="name">
            
          
                        <label for="year">Year:</label>
                        <input class="mdl-textfield__input" type="text" name="year" id="year">
                  
                    
                                <label for="section">Section:</label>
                                <input class="mdl-textfield__input" type="text" name="section" id="section">
                     
                              
                                              
            </div>
            
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit Information">
                </div>
                </div>
                </div>
                </div>
            </form>
@endsection



    
    

    
                
  
