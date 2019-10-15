@extends('layouts.user')
<style>
    #searchbar{
      position: relative;
      left: 1%;
    }
        .mdl-data-table th, td{
  text-align: left !important;
}
  </style>
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
                
                
       <div class="col-lg-12 col-md-offset-0">
                    <div class="panel panel-default">
                        <div class="panel-heading">Class List</div>
                        <br>
                        <div id="searchbar">
            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs">Add Student </a> 
            <a href="{{route('class_list.excel',$class_subject_teachers->class_id)}}"class="btn btn-primary btn-xs">Export to Excel</a>
    </div>
                <div class="panel-body"> 
                            <div class="table-responsive">
                    
                                    
                               <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                           
                           <thead>
                           
                                <th>Student's Name</th>
                                <th>Delete</th>
                           
                                
                           </thead>
            <tbody>
                    <?php $i=1  ?>
                    @foreach($class_students as $class)
                    <tr>
                        
                            <td>{{$i}}. {{$class->students->get(0)->name}}</td>
                            <?php $i++ ?>
                         <form action = "{{route('class_list.delete',[$class->student_id])}}" method="post" enctype="multipart/form-data">
            
                                    {{csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-sm" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                </form>
    
        </tr>
            @endforeach
     
           
            
            </tbody>
                
        </table>
    </div> 
      
</div>




<form action = "{{route('class_list.add', $class_subject_teachers->class_id)}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
          <div class="form-group">
             
            <label>Student Name:</label>
            <select class="form-control select2" id="student_id" name="student_id" style="width: 100%;">
                      
                    @foreach($students as $student)
                    <option value="{!! $student->id !!}"> {!! $student->name !!}</option>
                 @endforeach
            </select>
          </div>
       
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Submit Information">
      </div>
    </div>
  </div>
</div>
</form>

    </div>
@endsection
