
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
                
                
                <div class="col-md-12">
                <legend>Schedule</legend>
    
                <div class="table-responsive">
        
                        
                      <table id="mytable" class="table table-bordred table-striped">
                           
                           <thead>
                           
                                         <th>Subject</th>
                                                
                                        <th>Teacher</th>
                                        <th>Schedule</th>
                                     
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Add</th>
                               
                           </thead>
            <tbody>
            
                             
                @foreach($class_subject_teachers as $class_subject_teacher)         
                <tr>
                    <td>{{$class_subject_teacher->subjects->get(0)->title}}</td>
                    <td>{{$class_subject_teacher->teachers->get(0)->name}}</td>
                    <td>{{$class_subject_teacher->schedule}}</td>
                           
                       
           
                        <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $class_subject_teacher->id !!}" data-target="#edit-{{$class_subject_teacher->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                       
                        <form action="{{route('class_subject.destroy',[$class_subject_teacher->id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
            <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
            </form>
        </tr>
            @endforeach
     
           
            
            </tbody>
                
        </table>
    </div>
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
      @foreach($classes as $class)
      <form action = "{{route('addsubjtoclass.store',$class->id)}}" method="post" enctype="multipart/form-data">
                                
        {{csrf_field() }}
        @endforeach
      <div class="modal-body">
      
       
        <div class="form-group">
           @foreach($classes as $class)
            <input type="hidden" name="class_id" id="class_id" class="form-control" value="{{$class->id}}"> 
         @endforeach
        </div>
    
        <div class="form-group">
            <label>Subject:</label>
            <select class="form-control select2" id="subject_id" name="subject_id" style="width: 100%;">
      
                @foreach($subjects as $subject)
                <option value='{{ $subject->id }}'>{{ $subject->title }}</option>
            @endforeach
            </select>
          </div>
          <div class="form-group">
              <label>Teacher:</label>
              <select class="form-control select2" id="teacher_id" name="teacher_id" style="width: 100%;">
        
                  @foreach($teachers as $teacher)
                  <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
                <label>Schedule:</label>
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
        <form action = "{{route('addsubjtoclass.update',$class->id)}}" method="post" enctype="multipart/form-data">                
          {{csrf_field() }}
          <input name="_method" type="hidden" value="PUT">

          <div class="modal fade" id="edit-{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editLabel">Edit Schedule</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>         
        <div class="modal-body">
        
       
              <label>Subject:</label>
              <select class="form-control select2" id="subject_id" name="subject_id" style="width: 100%;">
        
                  @foreach($subjects as $subject)
                  <option value='{{ $subject->id }}'>{{ $subject->title }}</option>
              @endforeach
              </select>
         
              <label for="teacher_id">Teacher:</label>
              <select class="form-control select2" name="teacher_id" id="teacher_id">
          
                  @foreach($teachers as $teacher)
                  <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                  @endforeach
          </select>
         
          <label for="schedule">Schedule</label>
          <input type="text" name="schedule" id="schedule" value="{{$class->schedule}}" class="form-control" placeholder="Days/Time start/Time end"> 
     
 
        
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
           
          
    
    
      
        @endsection
    


 