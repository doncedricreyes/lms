


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
                                <legend>{{$teachers->get(0)->name}}</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Subjects</th>
                                        <th>Year and Section</th>
                                        <th>Section Name</th>
                                        <th>School Year</th>
                                      <th>Schedule</th>
                                      <th>Edit</th>
                                       <th>Delete</th>
                                       <th> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Add</th>
                                        <th> <a href="{{route('teacher_schedule.excel',$teachers->get(0)->id)}}"class="btn btn-primary">Export to Excel</a></th>
                                   </thead>
                    <tbody>
                    
                            @foreach($class_subject_teachers as $row)
                            <tr>
                                <td>{{$row->subjects->get(0)->title}}</td>
                                <td>{{$row->classes->get(0)->year}}-{{$row->classes->get(0)->section}} </td>
                                <td>{{$row->classes->get(0)->section_name}} </td>
                                <td>{{$row->classes->get(0)->school_year}} </td>
                                <td>{{$row->schedule}}</td>
                                
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal"  data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                   
                    <form action="/admin/teachers/{{$row->id}}/subjects" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top"  onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                   
                </form>
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>












    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="createLabel">Add Subject</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               
                <form action = "{{route('addsubject',$teachers->get(0)->id)}}" method="post" enctype="multipart/form-data">
                                          
                  {{csrf_field() }}
                
                <div class="modal-body">
                
                 
                  <div class="form-group">

                        <label for="year">Year:</label>
                        <input type="text" name="year" id="year" class="form-control"> 
                        
                        <label for="section">Section:</label>
                        <input type="text" name="section" id="section" class="form-control"> 

                        
                        <label for="school_year">School Year:</label>
                        <input type="text" name="school_year" id="school_year" class="form-control"> 
                        
                        <label for="section_name">Section Name:</label>
                        <select class="form-control select2" id="section_name" name="section_name" style="width: 100%;">
                    
                            @foreach($classes as $class)
                            <option value='{{ $class->section_name }}'>{{ $class->section_name}}</option>
                        @endforeach
                        </select>
              
                        <div class="form-group">
                          <label>Subject:</label>
                          <select class="form-control select2" id="subject_id" name="subject_id" style="width: 100%;">
                    
                              @foreach($subjects as $subject)
                              <option value='{{ $subject->id }}'>{{ $subject->title }}</option>
                          @endforeach
                          </select>
                        </div>
                        
                   
               
                  <label for="schedule">Schedule</label>
                  <input type="text" name="schedule" id="schedule" class="form-control" placeholder="Days/Time start/Time end"> 
             
              </div>
                
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
              </div>
            </div>
          </div>










          @foreach($class_subject_teachers as $class)
          <form action = "{{route('schedule.update',$class->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="class_id" id="class_id" value="{{$class->class_id}}">
                              <div class="form-group">
                                
                        <label for="year">Year:</label>
                        <input type="text" name="year" id="year" value="{{$class->classes->get(0)->year}}"  class="form-control" > 
                        
                        <label for="section">Section:</label>
                        <input type="text" name="section" id="section" value="{{$class->classes->get(0)->section}}"  class="form-control" > 

                        
                        <label for="school_year">School Year:</label>
                        <input type="text" name="school_year" id="school_year" value="{{$class->classes->get(0)->school_year}}"  class="form-control" > 
                        
                        <label for="section_name">Section Name:</label>
                        <input type="text" name="section_name" id="section_name" value="{{$class->classes->get(0)->section_name}}"  class="form-control" > 
                <label>Subject:</label>
                <select class="form-control select2" id="subject_id" name="subject_id" style="width: 100%;">
          
                    @foreach($subjects as $subject)
                    <option value='{{ $subject->id }}'>{{ $subject->title }}</option>
                @endforeach
                </select>
              </div>
  
        <label for="schedule">Schedule</label>
        <input type="text" name="schedule" id="schedule" value="{{$class->schedule}}" class="form-control" placeholder="Days/Time start/Time end"> 
      
  
            
            </div>
      
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit Information">
            </div>
            </div>
            </div>
            </div>
            </form>
            
            @endforeach
              </div>
            </div>
          </div>
                    </div>
@endsection



    
    

    
                
  