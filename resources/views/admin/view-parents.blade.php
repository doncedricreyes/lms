


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
                                <legend>{{$parents->get(0)->name}}</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name of Student</th>
                                        <th>Year and Section</th>
                                        <th>Section Name</th>
                                        <th>School Year</th>
                                
                                   
                                     
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($class_students as $row)
                            <tr>
                                <td>{{$row->students->get(0)->name}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$row->class_subject_teachers->get(0)->classes->get(0)->section}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->section_name}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->school_year}}</td>
                            
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>












    
                    </div>
@endsection



    
    

    
                
  