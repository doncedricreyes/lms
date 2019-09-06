


   


@extends('layouts.user')

@section('content')
<style>
                #submit{
                    position: relative;
                    left: 70%;

                }
                </style>
                @if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
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
     
     
     
            <legend>Edit Exam/Quiz</legend>
     

          
        
                  
            @foreach($exams as $id)
            <form action = "{{route('exam.update',$id->id)}}" method="post"enctype="multipart/form-data">
                    {{csrf_field() }}
                    @endforeach
                    <input name="_method" type="hidden" value="PUT">
                    
            <div class="form-group">
            <label for="quarter">Quarter:</label>
            <select class="form-control  input-sm" name="quarter" id="quarter">
              <option value="1">1st Quarter</option>
              <option value="2">2nd Quarter</option>
              <option value="3">3rd Quarter</option>
              <option value="4">4th Quarter</option>
            </select>
          </div>
          

            <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             @foreach($exams as $exam)
                        <input class="mdl-textfield__input" type="text"   id="title" name="title" value="{{$exam->title}}">
               @endforeach
                        <label class="mdl-textfield__label">Title</label>
                    </div>
                    
                </div>
            <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        @foreach($exams as $exam)
                                         <label class="mdl-textfield__label">Date Start</label>
                                         <br>
                                <input class="mdl-textfield__input" type="datetime-local"   id="date_start" name="date_start" value="{{$exam->date_start}}">
                                @endforeach
                               
                            </div>
                </div>
            <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        @foreach($exams as $exam)
                                          <label class="mdl-textfield__label">Date End:</label>
                                          <br>
                                <input class="mdl-textfield__input" type="datetime-local"  id="date_end" name="date_end" value="{{$exam->date_end}}">
                                @endforeach
                              
                            </div>
                </div>
              
                <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        @foreach($exams as $exam)
                                <input class="mdl-textfield__input" type="number"  id="total_score" name="total_score" value="{{$exam->total_score}}">
                                @endforeach
                                <label class="mdl-textfield__label">Total Score:</label>
                            </div>
                </div>
                <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        @foreach($exams as $exam)
                                <input class="mdl-textfield__input" type="number"  id="passing_score" name="passing_score" value="{{$exam->passing_score}}">
                                @endforeach
                                <label class="mdl-textfield__label">Passing Score:</label>
                            </div>
                </div>
                  <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    @foreach($exams as $exam)
                            <input class="mdl-textfield__input" type="number"  id="attempts" name="attempts" value="{{$exam->attempts}}">
                            @endforeach
                            <label class="mdl-textfield__label">Attempts:</label>
                        </div>
            </div>
                <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        @foreach($exams as $exam)
                                <input class="mdl-textfield__input" type="text" placeholder="minutes"  id="time" name="time" value="{{$exam->time/60}}">
                                @endforeach
                                <label class="mdl-textfield__label">Time in minutes:</label>
                            </div>
                </div>
                <div class="col-lg-12 p-t-20">
                <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                                Update
                           </button>
                </div>
            </form>
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  
