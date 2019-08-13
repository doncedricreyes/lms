


   


@extends('layouts.user')


 
  
<style>
        .demo-card-wide.mdl-card {
          width: 100%;
          
        }
        .demo-card-wide {
         
          height: 200%;
         
        }
        .mdl-card-title{
            height: 100%;
        }
      #button{
        position: relative;
        float: right;
      
      }
      #question{
        position: relative;
        height: 40%;
      }
      #score{
        position: absolute;
        top:70%;
        left:80%;
      
        
      }
     
        </style>
               
        
@section('content')    
<div class="container" id="view">
@if($exams->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->
  
  
  
      <?php $i=1  ?>
        @foreach($questions as $question)
        <div id="button">
            <form action="{{route('questions.delete',[$question->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
          <a href="{{route('questions.edit',$question->id)}}" class="btn btn-primary">Edit</a>
            <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary" value="Delete"></a>
        </form>
      </div>
    <div id="question" class="demo-card-wide mdl-card mdl-shadow--2dp">
      <nav class="col-lg-1 pull-right">
  
      </nav>
            <div class="mdl-card__title">
             
         
              <h2 class="mdl-card__title-text"> 
                   <h3> Question no.   {{$i}}      {{$question->question}}</h3>
                                </h2>
                                <?php $i++ ?>
                               
            </div>
        
            <div class="mdl-card__actions mdl-card--border">
          
             
              <div class="mdl-card__supporting-text">
     
                <input type="hidden" name="id" value={{$question->id}}>
            
                    @if(count($question->option_1)>0)
                      <input type="radio" id="answer"  name="answer" value="{{$question->option_1}}"> {{$question->option_1}}<br>
                      @endif
                      @if(count($question->option_2)>0)
                      <input type="radio" name="answer" value="{{$question->option_2}}"> {{$question->option_2}}<br>
                      @endif
                      @if(count($question->option_3)>0)
                      <input type="radio" name="answer" value="{{$question->option_3}}"> {{$question->option_3}}<br>
                      @endif
                      @if(count($question->option_4)>0)
                      <input type="radio" name="answer" value="{{$question->option_4}}"> {{$question->option_4}}<br>
                      @endif
                      @if(count($question->option_5)>0)
                      <input type="radio" id="answer" name="answer" value="{{$question->option_5}}"> {{$question->option_5}}<br>
                      @endif
                      @if(count($question->option_1)<=0 & count($question->option_2)<=0 && count($question->option_3)<=0 && count($question->option_4)<=0 && count($question->option_5)<=0)
                      <label for="answer">Answer:</label>
                      <input type="text" id="answer" name="answer" class="form-control"> <br>
                      
                      @endif
                      <div id = "score" class="score">
                      <h5>Correct Answer:   {{$question->answer}}</h5>
                      <h5>Score:   {{$question->score}}</h5>
                      </div>

   
                      </div> 
                    
                   
              </div>
         
         
            </div><br><br>
            @endforeach
     
               
          
            
                
</div>

@endif












      
@endsection

            

    
                
  
        
        

   

            

    
                
  