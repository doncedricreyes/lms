


   


@extends('layouts.user')

<style>
    .table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
@media screen and (max-width: 767px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
    .table-responsive > .table-bordered {
        border: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:first-child,
    .table-responsive > .table-bordered > tbody > tr > th:first-child,
    .table-responsive > .table-bordered > tfoot > tr > th:first-child,
    .table-responsive > .table-bordered > thead > tr > td:first-child,
    .table-responsive > .table-bordered > tbody > tr > td:first-child,
    .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:last-child,
    .table-responsive > .table-bordered > tbody > tr > th:last-child,
    .table-responsive > .table-bordered > tfoot > tr > th:last-child,
    .table-responsive > .table-bordered > thead > tr > td:last-child,
    .table-responsive > .table-bordered > tbody > tr > td:last-child,
    .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }
    .table-responsive > .table-bordered > tbody > tr:last-child > th,
    .table-responsive > .table-bordered > tfoot > tr:last-child > th,
    .table-responsive > .table-bordered > tbody > tr:last-child > td,
    .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
    }
}
}
</style>
@section('content')
@if($assignments->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
      
    @foreach($student_assignments as $id)     
    <form id="answer"action="{{route('student.store.assignment',$id->assignment_id)}}" method="post" class="ansform">@endforeach 
        {{csrf_field() }}
    <div class="row">
        <div class="col-lg-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">Students</div>

            <div class="panel-body">    
                <div class="table-responsive">
                    <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>File</th>
                            <th>Date Submitted</th>
                            <th>Grade</th>
                            @if($assignments->get(0)->class_subject_teachers->teacher_id == Auth::user()->id)
                             <th>Submit</th>
                             @endif
                        </tr>
                    </thead>
                    <tbody>
                  
     
                            @foreach($student_assignments as $id)
               
                            <form action="{{route('student.store.assignment',$id->assignment_id)}}" method="post" class="ansform">   @endforeach
                                {{csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">  
                             
                            @foreach($student_assignments as $id) 
                                    <tr>
                                        <td>{{$id->students->get(0)->name}}</td>
                                        <td><a href="/storage/assignments/{{$id->file}}" download="{{$id->file}}"><div class="icon material-icons">assignment</div>{{$id->file}}</a></td>
                                        <td>{{$id->created_at}}</td>
                                        <input type="hidden" name="grades[{{$loop->index}}][assignment_id]" value="{{$id->assignment_id}}">
                                        <input type="hidden" name="grades[{{$loop->index}}][file]" value="{{$id->file}}">
                                        <input type="hidden" name="grades[{{$loop->index}}][student_id]" value="{{$id->student_id}}">
                                     <input type="hidden" name="grades[{{$loop->index}}][id]" value="{{$id->id}}">
                                     @if($assignments->get(0)->class_subject_teachers->teacher_id != Auth::user()->id)
                                        <td>{{$id->grade}}</td>
                                        @endif
                                     @if($assignments->get(0)->class_subject_teachers->teacher_id == Auth::user()->id)
                                        <td><input type="number" name="grades[{{$loop->index}}][grade]" id="{{$id->grade}}" value="{{$id->grade}}"></td>
                                       <td><input type="submit" name="submit" value="submit" class="btn btn-primary" id="submitbtn"></td>
                                       @endif
                                    </tr>
                                                    
                                            </tbody>
                                            
                                            
                                    </form>
                                    @endforeach
                                  
                                        </table>
</div>
                                       
            </div>
        </div>
    </div>
</div>
</div>

@endif

 

@endsection

            

    
                
  
        
        

   

            

    
                
  