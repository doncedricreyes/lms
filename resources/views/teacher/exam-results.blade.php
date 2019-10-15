


   


@extends('layouts.user')

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
@section('content')
@if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
 
      
    <div class="row">
             <div class="col-lg-12 col-md-offset-0">
                    <div class="panel panel-default">
            <div class="panel-heading" id="head">Results</div>
            <br>
                <form action="{{route('exam.results',$exams->get(0)->id)}}" method="GET">
                        <div id="searchbar">
                <select  name="attempt" id="attempt" onchange="this.form.submit()">
                    <option disabled selected value> -- select attempt -- </option>
                   @for($i=1; $i <= $exams->get(0)->attempts;$i++)
                 <option value={{$i}}>Attempt {{$i}}</option>
                 @endfor
               </select>
                        </div>
            </form>
            

            <div class="panel-body">   
                    <div class = "table-responsive"> 
                            <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Attempt</th>
                            <th>Result</th>
                            <th>Passing Score </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
           @isset($grades)
                      @foreach($grades as $exam_grade)
            <tr>
                
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->students->get(0)->name}}</td>
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->attempt}}</td>  
                <td>{{$exam_grade->get(0)->grade}}</td>
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->exams->get(0)->passing_score}}</td>
                
                
            </tr>
                            @endforeach
                            @endisset
                    </tbody>
                </table>
                    </div>
            </div>
        </div>
    </div>
</div>
     

</div>
@endif

@endsection

            

    
                
  
        
        

   

            

    
                
  
