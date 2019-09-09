


   


@extends('layouts.user')

@section('content')

<style>
        #submit{
            position: relative;
            float: right;
        }
    </style>
<div class="container" id="view">
        @if(count($exam_grades)>0)
    <div class="container">
        <div class="row">
            
           
            <div class="col-md-12">
                    <legend>{{$exam_grades->get(0)->quiz_attempt->get(0)->exams->get(0)->title}}</legend>

            <div class="table-responsive">
    
                    
                  <table id="mytable" class="table table-bordred table-striped">
                       
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
        

@endif

</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
