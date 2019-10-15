


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
                  </div>
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
                            <div class="panel-heading">Students</div>
                            <br>
                        <div class="form-group">
                                <form action = "{{route('search_student')}}" role="search" method="get"enctype="multipart/form-data">
                              <div id="searchbar">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search"  style="width: 300px;">
                            <br>
                            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs">Add Student </a>
                            <a href="{{url('admin/students/export/excel')}}"class="btn btn-primary btn-xs">Export to Excel</a>
                            <a href="" data-toggle="modal" data-target="#import" class="btn btn-primary btn-xs">Import</a>
                            <br>
                                  </div>
                                </form>
                          </div>
                           <div class="panel-body"> 
                        <div class="table-responsive">
                
                                
                               <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                       <th>Delete</th>
                                       <th>Message</th>
                                        <th>Status</th>
                                   </thead>
                    <tbody>
                    
                            @foreach($students as $row)
                            <tr>
                                <td>{{ ($students ->currentpage()-1) * $students ->perpage() + $loop->index + 1 }}. {{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="/admin/students/{{$row->id}}"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                             <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                             
                                
                                <form action="{{route('admin.student.destroy',[$row->id])}}" method="POST">
                     
                                  {{csrf_field() }}
                                  <input name="_method" type="hidden" value="PUT">
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                    <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="/admin/students/{{$row->id}}/message"><button class="btn btn-primary btn-sm" data-title="View"><i class="glyphicon glyphicon-comment">
                    <td>{{$row->status}}</td>
               </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                    {{ $students->links() }}
                   
                    </div>
    </div>



    <form action = "{{route('add-student.store')}}" method="post"  enctype="multipart/form-data">
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
                 
                    <label for="name">Student's Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter last name, first name middle initial"> 
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" name="year" id="year" class="form-control" placeholder="Enter year">
                </div>
                <div class="form-group"> 
                    <label for="section">Section:</label>
                    <input type="text" name="section" id="section" class="form-control" placeholder="Enter section"> 
                </div>
                <div class="form-group">
                    <label for="username"> Username:</label>
                    <input type="username" name="username" id="username" class="form-control"placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password"> Create a password:</label>
                    <input type="password" name="password" title="password" class="form-control" placeholder="Enter password">
       
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
  <form action = "{{route('student.import')}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="importlabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importlabel">Import File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
          <div class="form-group">
             
            <label for="file_name">Choose file to upload:</label>
            <input class="form-control" type="file" name="file_name" id="file_name" >
        </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Upload">
      </div>
    </div>
  </div>
</div>
</form>
    </div>


    @foreach($students as $row)
    <form action = "{{route('admin.update_student', $row->id)}}" method="post" enctype="multipart/form-data">
        
        {{csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
                 
            <label for="name">Student's Name:(Last Name, First Name Middle Initial)</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$row->name}}"> 
        </div>
        <div class="form-group">
            <label for="username"> Username:</label>
            <input type="username" name="username" id="username" class="form-control" value="{{$row->username}}">
        </div>
        <div class="form-group">
            <label for="password"> Create a password:</label>
            <input type="password" name="password" title="password" class="form-control" placeholder="Enter password">

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
</div>
@endsection




            

    
                
  
