


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
                                <legend>{{$students->get(0)->name}}</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Subjects</th>
                                        <th>Year and Section</th>
                                        <th>Section Name</th>
                                        <th>School Year</th>
                                      <th>Schedule</th>
                                      <th><a href="/admin/students/{{$students->get(0)->id}}/message"> <button type="button" class="btn btn-primary">Message</button></a></th>
                                      @empty(!$class_students->get(0)->parent_id)
                                      <th><a href="/admin/parents/{{$class_students->get(0)->parent_id}}/message"> <button type="button" class="btn btn-primary">Message Parent</button></a></th>
                                      @endempty
                                      @empty($class_students->get(0)->parent_id)
                                      <th>Parent/Guardian is not yet registered!</th>
                                      @endempty
                                     
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($class_students as $row)
                            <tr>
                                <td>{{$row->class_subject_teachers->get(0)->subjects->get(0)->title}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$row->class_subject_teachers->get(0)->classes->get(0)->section}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->section_name}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->school_year}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->schedule}}</td>
                            
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>












    
                    </div>
@endsection



    
    

    
                
  
