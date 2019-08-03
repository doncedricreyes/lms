


   


@extends('layouts.user')

@section('content')

<div class="container" id="view">
 

  @foreach($exam_grades as $exam)
            <legend><h1>{{$exam->exams->get(0)->title}}</h1></legend>
       
            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text" value="{{$exam->students->get(0)->name}}" id="title" name="title" readonly>
           
                    <label class="mdl-textfield__label">Name:</label>
                </div>
                
            </div>
            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text" value="{{$exam->exams->get(0)->total_score}}" id="title" name="title" readonly>
           
                    <label class="mdl-textfield__label">Total Score:</label>
                </div>
                
            </div>
            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text" value="{{$exam->exams->get(0)->passing_score}}" id="title" name="title" readonly>
           
                    <label class="mdl-textfield__label">Passing Score:</label>
                </div>
                
            </div>
            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text" value="{{$exam->grade}}" id="title" name="title" readonly>
           
                    <label class="mdl-textfield__label">Grade:</label>
                </div>
                
            </div>
            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text" value="{{$exam->Status}}" id="title" name="title" readonly>
           
                    <label class="mdl-textfield__label">Status:</label>
                </div>
                
            </div>


<a href="/student/class/{{$exam_grades->get(0)->exams->get(0)->class_subject_teacher_id}}" class="btn btn-primary">Continue</a>

@endforeach
@if($exam == "")
<h1>You haven't completed this exam/quiz yet.</h1>
@endif
</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  