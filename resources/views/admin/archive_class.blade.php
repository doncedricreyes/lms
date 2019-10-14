


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
                             
                </tr>
                    @endforeach
             
                   
                    
                    </tbody>
                        
                </table>
            </div> 
              
        </div>
                     


            
@endsection




