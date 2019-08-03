


   


@extends('layouts.user')

@section('content')
<style>
        #submit{
            position: relative;
            left: 70%;
        }
        </style>

@if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
@if($questions->get(0)->exam_id == $exams->get(0)->id)
<div class="container" id="view">
 
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
     
     
            <legend>Edit Question</legend>
     

          
        
                  
           

            @foreach($questions as $id)
            <form action = "{{route('questions.update',$id->id)}}" method="post" enctype="multipart/form-data">        @endforeach
                    {{csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
  
          @foreach($questions as $id)
            <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                            <textarea class="mdl-textfield__input" type="text" rows= "7" value="{{$id->question}}" id="question" name="question">{{$id->question}}</textarea>
               
                        <label class="mdl-textfield__label">Question:</label>
                    </div>
                    
                </div>
            
          
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text" value="{{$id->option_1}}"  id="option_1" name="option_1">
                   
                            <label class="mdl-textfield__label">Option 1:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"value="{{$id->option_2}}"   id="option_2" name="option_2">
                   
                            <label class="mdl-textfield__label">Option 2:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"value="{{$id->option_3}}"   id="option_3" name="option_3">
                   
                            <label class="mdl-textfield__label">Option 3:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text" value="{{$id->option_4}}"  id="option_4" name="option_4">
                   
                            <label class="mdl-textfield__label">Option 4:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text" value="{{$id->option_5}}"  id="option_5" name="option_5">
                   
                            <label class="mdl-textfield__label">Option 5:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text" value="{{$id->answer}}"   id="answer" name="answer">
                   
                            <label class="mdl-textfield__label">Correct Answer:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                     
                                <input class="mdl-textfield__input" type="number" value="{{$id->score}}"  id="score" name="score">
                       
                                <label class="mdl-textfield__label">Score:</label>
                            </div>
                            
                        </div>
                    @endforeach
                    <div class="col-lg-12 p-t-20">
                <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                        Update
                   </button>
                    </div>
            </form>
</div>
@endif
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  