


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
                        <legend>Classes</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                        <th>School Year</th>
                                        <th>Year and Section</th>
                                        <th>Section Name</th>
                                        <th>Adviser</th>
                                        <th>Time</th>
                                        <th>Room</th>
                                        <th>Subjects</th>
                                        <th>Class List</th>
                                      <th>Edit</th>
                                       <th>Delete</th>
                                       <th> <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create">Add</th>
                                        <th> <a href="{{url('admin/class/export/excel')}}"class="btn btn-primary btn-xs">Export to Excel</a></th>
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
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="class/{{$class->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="class/students/{{$class->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                                <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $class->id !!}" data-target="#edit-{{$class->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                
                                <form action="{{route('class.destroy',[$class->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-xs" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                </tr>
                    @endforeach
             
                   
                    
                    </tbody>
                        
                </table>
            </div> 
              
        </div>
                     

        
            
@endsection




