


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
                                
                                    
                                   </thead>
                    <tbody>
                    
                            @foreach($teachers as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                               <td>{{$row->status}}</td>
                </tr>
                    @endforeach
               
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                    {{ $teachers->links() }}
                   
                    </div>
    </div>

    
  
                </div>
@endsection



    
    

    
                
  
