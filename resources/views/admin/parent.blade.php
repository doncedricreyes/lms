


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
                        <legend>Parents</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Username</th> 
                                        <th>Email</th>
                                        <th>View</th>
                                       <th>Delete</th>
                                       <th>Message</th>
                                       <th> <a href="{{url('/admin/create/parents')}}"class="btn btn-primary btn-xs">Add</a></th>
                                   </thead>
                    <tbody>
                    
                            @foreach($parents as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="/admin/parents/{{$row->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                   
                             
                                
                                <form action="{{route('admin.parents.destroy',[$row->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                    <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="parents/{{$row->id}}/message"><button class="btn btn-primary btn-xs" data-title="View"><i class="glyphicon glyphicon-comment">
                </tr>
                    @endforeach
                    <div class="text-center">
                    {{ $parents->links() }}
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>


@endsection




            

    
                
  