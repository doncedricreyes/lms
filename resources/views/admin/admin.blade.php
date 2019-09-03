


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
                <div class="container">
                    <div class="row">
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                                <legend>Admins</legend>
                  <form action = "{{route('search_admin')}}" role="search" method="get"enctype="multipart/form-data">
                                  <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                      </form>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>  
                                        <th>Role</th>
                                        @if(Auth::user()->role == 'superadmin')
                                        <th>Delete</th>
                                        <th> <a href="{{url('admin/create')}}"class="btn btn-primary btn-xs">Add</a></th>                              
                                        @endif
                                     
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($admins as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="admins/{{$row->id}}/message"><button class="btn btn-primary btn-xs" data-title="View"><i class="glyphicon glyphicon-comment">
                                <td>{{$row->role}}</td>
                               
                                @if(Auth::user()->role == 'superadmin')
                                <form action="{{route('admin.destroy',[$row->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-xs" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                    </form>
                                    @endif
                                </i></button></a></p></td>
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>












    
                    </div>
@endsection



    
    

    
                
  
