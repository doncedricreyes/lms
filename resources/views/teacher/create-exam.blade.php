


   


@extends('layouts.user')

@section('content')
<style>
    #submit{
        position: relative;
        left:70%;
    }
    </style>
    @if($class_subject_teachers->get(0)->teacher_id == auth::user()->id)
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
     
     
            <legend>Create Exam/Quiz</legend>
     

          
        
                  
            @foreach($class_subject_teachers as $id)
            <form action = "{{route('exam.store',$id->id)}}" method="post">
                    {{csrf_field() }}
                    @endforeach

                    
            <div class="form-group">
            <label for="quarter">Quarter:</label>
            <select class="form-control" name="quarter" id="quarter">
              <option value="1">1st Quarter</option>
              <option value="2">2nd Quarter</option>
              <option value="3">3rd Quarter</option>
              <option value="4">4th Quarter</option>
            </select>
          </div>
          

            <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                        <input class="mdl-textfield__input" type="text"   id="title" name="title">
               
                        <label class="mdl-textfield__label">Title</label>
                    </div>
                    
                </div>
            <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input class="mdl-textfield__input" type="datetime-local"   id="date_start" name="date_start">
                                <label class="mdl-textfield__label">Date Start</label>
                            </div>
                </div>
            <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input class="mdl-textfield__input" type="datetime-local"  id="date_end" name="date_end">
                                <label class="mdl-textfield__label">Date End:</label>
                            </div>
                </div>
             
                <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input class="mdl-textfield__input" type="number"  id="total_score" name="total_score">
                                <label class="mdl-textfield__label">Total Score:</label>
                            </div>
                </div>
                <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input class="mdl-textfield__input" type="number"  id="passing_score" name="passing_score">
                                <label class="mdl-textfield__label">Passing Score:</label>
                            </div>
                </div>
                <div class="hidden">
                        <div class="hidden">
                                <input class="mdl-textfield__input" type="number"  id="attempts" name="attempts" value="1">
                                <label class="mdl-textfield__label">Attempts:</label>
                            </div>
                </div>

                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input class="mdl-textfield__input" type="text"  id="time" name="time" placeholder="minutes">
                                <label class="mdl-textfield__label">Time in minutes:</label>
                            </div>
                </div>
                <div class="col-lg-12 p-t-20">
                <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                        Create
                   </button>
                </div>
            </form>
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  