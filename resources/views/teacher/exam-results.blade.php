


   


@extends('layouts.user')

<style>
    .table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
@media screen and (max-width: 767px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
    .table-responsive > .table-bordered {
        border: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:first-child,
    .table-responsive > .table-bordered > tbody > tr > th:first-child,
    .table-responsive > .table-bordered > tfoot > tr > th:first-child,
    .table-responsive > .table-bordered > thead > tr > td:first-child,
    .table-responsive > .table-bordered > tbody > tr > td:first-child,
    .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:last-child,
    .table-responsive > .table-bordered > tbody > tr > th:last-child,
    .table-responsive > .table-bordered > tfoot > tr > th:last-child,
    .table-responsive > .table-bordered > thead > tr > td:last-child,
    .table-responsive > .table-bordered > tbody > tr > td:last-child,
    .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }
    .table-responsive > .table-bordered > tbody > tr:last-child > th,
    .table-responsive > .table-bordered > tfoot > tr:last-child > th,
    .table-responsive > .table-bordered > tbody > tr:last-child > td,
    .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
    }
}
</style>
@section('content')
@if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
 
        
    <div class="row">
        <div class="col-lg-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">Results
             <form action="{{route('exam.results',$exams->get(0)->id)}}" method="GET">
                <select  name="attempt" id="attempt" onchange="this.form.submit()">
                    <option disabled selected value> -- select attempt -- </option>
                   @for($i=1; $i <= $exams->get(0)->attempts;$i++)
                 <option value={{$i}}>Attempt {{$i}}</option>
                 @endfor
               </select>
            </form>
            </div>

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
                       
         
                      @foreach($grades as $exam_grade)
            <tr>
                
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->students->get(0)->name}}</td>
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->attempt}}</td>  
                <td>{{$exam_grade->get(0)->grade}}</td>
                <td>{{$exam_grade->get(0)->quiz_attempt->get(0)->exams->get(0)->passing_score}}</td>
                
                
            </tr>
                            @endforeach
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

            

    
                
  
        
        

   

            

    
                
  
