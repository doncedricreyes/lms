


   


@extends('layouts.user')

@section('content')


<style>
        #submit{
         
            float: right;
        }
  
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
<div class="container" id="view">
@isset($exam_grades)
        @if($exam_grades)
    <div class="container">
        <div class="row">
            
           
                <div class="col-lg-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <div class="panel-heading"  id="head">{{$exam_grades->get(0)->quiz_attempt->get(0)->exams->get(0)->title}}</div>
                            <br>
                    

                            <div class="panel-body"> 
                                    <div class="table-responsive">
                            
                                     
                                      <table class="mdl-data-table mdl-js-data-table col-lg-12 mdl-shadow--2dp" >
                       
                       <thead>
                       
                       
                            <th>Attempt</th>
                            <th>Grade</th>
                            <th>Total Score</th>
                            <th>Passing Score</th>
                          <th>Status</th>
                         
                          
                       </thead>
        <tbody>
        
                @foreach($grades as $row)
                <tr>
                    <td>{{ $loop->iteration }} </td></td>
                    <td>{{$row->get(0)->grade}}</td>
                    <td>{{$row->get(0)->quiz_attempt->get(0)->exams->get(0)->total_score}}</td>
                    <td>{{$row->get(0)->quiz_attempt->get(0)->exams->get(0)->passing_score}}</td>
                    <td>{{$row->get(0)->Status}}</td>
                
                    

    </tr>
        @endforeach
    
       
        
        </tbody>
            
    </table>
</div>
        
<div  id="submit"> 
<a href="/student/class/{{$exam_grades->get(0)->quiz_attempt->get(0)->exams->get(0)->class_subject_teacher_id}}" class="btn btn-primary">Continue</a>
</div>
@endif

@endisset

</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
