


   


@extends('layouts.user')

@section('content')

<div class="container" id="view">
 
  <?php  $i = $exam_grades ?>
  @foreach($exams as $exam)
            <legend><h1>{{$exam->title}}</h1></legend>
            @endforeach
            @foreach($exams as $exam)
<h3>This exam will open on {{$exam->date_start}}
<h3>This exam will closed on {{$exam->date_end}}
<h3>Total Score: {{$exam->total_score}}</h3>
<h3>Passing Score: {{$exam->passing_score}}</h3>
<h3>Attempts: {{$exam->attempts}}</h3>



          @endforeach
        @foreach($exams as $id)
        @if ($id->date_start <= Carbon\Carbon::now('Asia/Manila')) 
        @if ($id->date_end > Carbon\Carbon::now('Asia/Manila')) 
       @if($exam_grades->get(0)['attempt'] == [])
        
     
        
          <a href="{{route('student.show.question',$id->id)}}" class="btn btn-primary">Attempt Quiz/Exam</a>       
        @else <h3> Exam is  closed </h3> 
    
@endif      
@endif
@endif


        <a href="{{route('student.show.result',$id->id)}}" class="btn btn-primary">View Results</a>
          @endforeach
</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
