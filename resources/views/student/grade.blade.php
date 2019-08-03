
@extends('layouts.user')

@section('content')
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>Grades</legend>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Subjects</th>
                                        <th>Teachers</th>   
                                        <th>1st Grading</th>
                                        <th>2nd Grading</th>
                                       <th>3rd Grading</th>
                                       <th>4th Grading</th>
                                       <th>Final</th>
                                       
                                   </thead>
                    <tbody>
                            @foreach($class_students as $row)
                            <tr>
                                <td>{{$row->class_subject_teachers->get(0)->subjects->get(0)->title}}</td>
                                <td>{{$row->class_subject_teachers->get(0)->teachers->get(0)->name}}</td>
                                <td>{{$row->first}}</td>
                                <td>{{$row->second}}</td>
                                <td>{{$row->third}}</td>
                                <td>{{$row->fourth}}</td>
                                <td>{{$row->final}}</td>       
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>


@endsection




            

    
                
  