@extends('layouts.user')

@section('content')
    <div class="container" id="view">
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>{{$class_students->get(0)->students->get(0)->name}}</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Subjects</th>
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
                               <td>{{$row->first}}</td>
                               <td>{{$row->second}}</td>
                               <td>{{$row->third}}</td>
                               <td>{{$row->fourth}}</td>
                               <td>{{$row->final}}</td>
                                @endforeach
                            </tr>
              
                   
                    
                    </tbody>
                </form>
                </table>
    </div>
    </div>


@endsection
