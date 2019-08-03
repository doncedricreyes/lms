


   


@extends('layouts.user')

@section('content')
<style>
        #submit{
            position: relative;
            left:70%;
        }
        </style>
        @if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
 
        <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
     
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
     
            <legend>Add Questions</legend>
     

          
        
                  
           

            @foreach($exams as $id)
            <form action = "{{route('question.store',$id->id)}}" method="post">
                    {{csrf_field() }}
          @endforeach

            <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                            <textarea class="mdl-textfield__input" type="text" rows= "7"  id="question" name="question"></textarea>
               
                        <label class="mdl-textfield__label">Question:</label>
                    </div>
                    
                </div>
            
                
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="option_1" name="option_1">
                   
                            <label class="mdl-textfield__label">Option 1:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="option_2" name="option_2">
                   
                            <label class="mdl-textfield__label">Option 2:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="option_3" name="option_3">
                   
                            <label class="mdl-textfield__label">Option 3:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="option_4" name="option_4">
                   
                            <label class="mdl-textfield__label">Option 4:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="option_5" name="option_5">
                   
                            <label class="mdl-textfield__label">Option 5:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                 
                            <input class="mdl-textfield__input" type="text"   id="answer" name="answer">
                   
                            <label class="mdl-textfield__label">Correct Answer:</label>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                     
                                <input class="mdl-textfield__input" type="number"   id="score" name="score">
                       
                                <label class="mdl-textfield__label">Score:</label>
                            </div>
                            
                        </div>
                        <div class="col-lg-12 p-t-20">
                <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                        Add
                   </button></div>
            </form>
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  