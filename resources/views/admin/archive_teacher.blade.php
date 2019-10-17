


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
                     
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                                <legend>Teachers</legend>
                                <form action = "{{route('archive_search_teacher')}}" role="search" method="get"enctype="multipart/form-data">
                                    <div>
                                  <input type="text" class="form-control" name="search" id="search" placeholder="Search" style="width: 300px;">
                                  <br>

                                    </div>
                                  </form>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    
                                   </thead>
                    <tbody>
                    
                            @foreach($teachers as $row)
                            <tr>
                                <td>{{$loop->iteration}}. {{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                               <td>{{$row->status}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                </tr>
                    @endforeach
               
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                    {{ $teachers->links() }}
                   
                    </div>
    </div>

    
   @foreach($teachers as $row)
                    <form action = "{{route('status_archive_teacher', $row->id)}}" method="post" enctype="multipart/form-data">
                        
                        {{csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">Edit Teacher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          
                           <div class="form-group">
                 
                <label for="name">Change Status:</label>
                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                          
                  
                  <option value="inactive"> Inactive</option>
                  <option value="active"> Active</option>
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
                    @endforeach     
                </div>
@endsection



    
    

    
                
  
