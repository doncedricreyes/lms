


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
                                <legend>Admins</legend>
                                <form action = "{{route('search_admin')}}" role="search" method="get"enctype="multipart/form-data">
                                  <div>
                                  <input type="text" class="form-control" name="search" id="search" placeholder="Search" style="width: 300px;">
                                  <br>
                                  <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs">Add Admin </a> 
                                  </div> 
                                      </form>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Message</th>  
                                        @if(Auth::user()->role == 'superadmin')
                                        <th>Edit</th>
                                        <th>Delete</th>
                                                           
                                        @endif
                                        <th>Status</th>
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($admins as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->role}}</td>
                                <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="admins/{{$row->id}}/message"><button class="btn btn-primary btn-xs" data-title="View"><i class="glyphicon glyphicon-comment">
                                 
                               
                                @if(Auth::user()->role == 'superadmin')
                                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                <form action = "{{route('admin.destroy',[$row->id])}}" method="post" enctype="multipart/form-data">
            
                                  {{csrf_field() }}
                                  <input name="_method" type="hidden" value="PUT">
                                  <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-xs" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                              </form>
                                    @endif
                                <td>{{$row->status}}</td>
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>







    <form action = "{{route('admin.create')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              
            <div class="form-group">
               
              <label>Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                  <label>Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
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
                    
                         
        @foreach($admins as $row)
        <form action = "{{route('admin.edit_admin', $row->id)}}" method="post" enctype="multipart/form-data">
            
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              
              <div class="form-group">
                 
                <label>Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$row->name}}">
              </div>
              <div class="form-group">
              <label for="status"> Status:</label>
              <select class="form-control" name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super admin</option>
             </select>
              </div>
              <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$row->email}}">
                  </div>
                  <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
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



    
    

    
                
  
