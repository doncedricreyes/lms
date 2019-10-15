


@extends('layouts.user')
<style>
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
  font-size: 28px;
  color: white;
}
#table{
  background-color:snow;
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
                                    <div id="table" class="panel panel-default">
                                        <div class="panel-heading" id="head">Classes</div>
                                        <br>
                                        <div id="searchbar">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create">Create Class</button>
                                        <a href="{{url('admin/class/export/excel')}}"class="btn btn-primary btn-xs">Export to Excel</a>
                                        <br>
                                        </div>
                                        <div class="panel-body"> 
                                                <div class="table-responsive">
                                        
                                                        
                                                  <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                        <th style="font-size:16px;">School Year</th>
                                        <th style="font-size:16px;">Year and Section</th>
                                        <th style="font-size:16px;">Section Name</th>
                                        <th style="font-size:16px;">Adviser</th>
                                        <th style="font-size:16px;">Time</th>
                                        <th style="font-size:16px;">Room</th>
                                        <th style="font-size:16px;">Subjects</th>
                                        <th style="font-size:16px;">Class List</th>
                                      <th style="font-size:16px;">Edit</th>
                                       <th style="font-size:16px;">Delete</th>
                                     
                                   </thead>
                    <tbody>
                    
                            @foreach($classes as $class)
                            <tr>
                                    <td>{{$class->school_year}}</td>
                                    <td>{{$class->year}}-{{$class->section}}</td>
                                     <td>{{$class->section_name}}</td>
                                     <td>{{$class->teachers->get(0)->name}}</td> 
                                     <td>{{$class->time}}</td>
                                     <td>{{$class->room}}</td> 
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="class/{{$class->id}}"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="class/students/{{$class->id}}"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                                <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-id="{!! $class->id !!}" data-target="#edit-{{$class->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                
                                <form action="{{route('class.destroy',[$class->id])}}" method="POST">
                                        {{ csrf_field() }}
                                         <input name="_method" type="hidden" value="PUT">
                    <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-sm" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                </tr>
                    @endforeach
             
                   
                    
                    </tbody>
                        
                </table>
            </div> 
              
        </div>
                     















        <form action = "{{route('add-class.store')}}" method="post" enctype="multipart/form-data">
    
            {{csrf_field() }}
          
            
            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="createLabel">Create Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                            <label>Adviser:</label>
                            <select class="form-control select2" id="adviser_id" name="adviser_id" style="width: 100%;">
                      
                                    @foreach($teachers as $teacher)
                                    <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                                 @endforeach
                            </select>
                          </div>
            
            <label for="school_year">School Year:</label>
            <input class="mdl-textfield__input" type="text" name="school_year" id="school_year">
        
      
                    <label for="year">Year:</label>
                    <input class="mdl-textfield__input" type="number" name="year" id="year">
              
                
                            <label for="section">Section:</label>
                            <input class="mdl-textfield__input" type="text" name="section" id="section">
                 
                          
                                    <label for="section_name">Section Name:</label>
                                    <input class="mdl-textfield__input" type="text" name="section_name" id="section_name">
                      
                                    <label for="time">Time:</label>
                                    <input class="mdl-textfield__input" type="text" name="time" id="time">

                                    <label for="room">Room:</label>
                                    <input class="mdl-textfield__input" type="text" name="room" id="room">
                      
    
                                          
        </div>
        
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit Information">
            </div>
            </div>
            </div>
            </div>
        </form>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        @foreach($classes as $class)
        <form action = "{{route('class.update', $class->id)}}" method="post" enctype="multipart/form-data">
            
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Edit Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                            <label>Adviser:</label>
                            <select class="form-control select2" id="adviser_id" name="adviser_id" style="width: 100%;">
                      
                                    @foreach($teachers as $teacher)
                                    <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                                 @endforeach
                            </select>
                          </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label for="school_year">School Year:</label>
          
            <input class="mdl-textfield__input" type="text" value="{{$class->school_year}}"  name="school_year" id="school_year">
          
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label for="year">Year:</label>
                    <input class="mdl-textfield__input" type="number" value="{{$class->year}}"  name="year" id="year">
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label for="section">Section:</label>
                            <input class="mdl-textfield__input" type="text" value="{{$class->section}}" name="section" id="section">
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label for="section_name">Section Name:</label>
                                    <input class="mdl-textfield__input" type="text" value="{{$class->section_name}}" name="section_name" id="section_name">
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label for="time">Time:</label>
                                        <input class="mdl-textfield__input" type="text" value="{{$class->time}}" name="time" id="time">
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label for="room">Room:</label>
                                                <input class="mdl-textfield__input" type="number" value="{{$class->room}}" name="room" id="room">
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
        @endforeach     
        
            
@endsection




