
@extends('layouts.user')
<style>
        #searchbar{
         
          display: block;
        text-align: center;
        }
       #search{
         position: relative;
         left: 37%;
       }
    
             .mdl-data-table th, td{
      text-align: left !important;
      font-size: 16px;
    }
    #head {
      background-color:#488cc7;
      text-align: center !important;
      font-size: 28px;
      color: white;
    }
    #table{
      background-color:snow;
    }
      </style>
@section('content')
            <div class="container">
                    <div class="row">
                        
                        
                            <div  class="col-lg-12 col-md-offset-0">
                                    <div id="table" class="panel panel-default">
                                        <div class="panel-heading" id="head">Grades</div>
                                        <br>
                                        
                                        <div  class="panel-body"> 
                                                <div  class="table-responsive">
                                        
                                                        
                                                  <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                   
                                        <th style="font-size:16px;">Subjects</th>
                                        <th style="font-size:16px;">Teachers</th>   
                                        <th style="font-size:16px;">1st Grading</th>
                                        <th style="font-size:16px;">2nd Grading</th>
                                       <th style="font-size:16px;">3rd Grading</th>
                                       <th style="font-size:16px;">4th Grading</th>
                                       <th style="font-size:16px;">Final</th>
                                       
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




            

    
                
  
