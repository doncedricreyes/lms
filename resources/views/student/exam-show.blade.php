


   


@extends('layouts.user')



 
@section('content')


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
        #submitbtn{
        float:right;
        }
        #finish{
          float:right;
        }
        </style>
               
            
<div class="container" id="view">
 

    <h4>Time Left: <div style="font-weight: bold" id="quiz-time-left"></div></h4>
    
  
  

        @foreach($questions as $question)
      
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <nav class="col-lg-1 pull-right">
     <div id="timer"></div>
        <div style="font-weight: bold" id="quiz-time-left"></div>
      </nav>
            <div class="mdl-card__title">
              <h2 class="mdl-card__title-text"> 
                    Question no. {{ $loop->iteration + $questions->firstItem() - 1 }}     {{$question->question}}
                                </h2>
            </div>
        
            <div class="mdl-card__actions mdl-card--border">
          
              <div class="mdl-card__supporting-text">
                  <form id="answer"action="{{route('student.store.answer',$question->exam_id)}}" name="quiz" method="post" class="ansform">
                      {{csrf_field() }}
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
                      <input type="submit"  name="submit" value="submit" class="btn btn-primary" id="submitbtn">


             
     
                    </form>
                      </div> 
                    
                      
              </div>
             
         
            </div>
        
              <br><br>
          
              @endforeach
              <div class="text-center">
                {{ $questions->links() }}
                Showing {{($questions->currentpage()-1)*$questions->perpage()+1}} to {{$questions->currentpage()*$questions->perpage()}}
                of  {{$questions->total()}} entries
                </div>
                
         @foreach($questions as $question)
         <form action="{{route('store.result',$question->exam_id)}}" method="post">
            {{csrf_field() }}
            @endforeach
              <input type="submit" id="finish" value="Finish"> 
         </form>
              </div>


             
             
              <script type="text/javascript">
                function countdown(seconds) {
    seconds = parseInt(localStorage.getItem("seconds"))||seconds;
  
    function tick() {
      seconds--; 
      localStorage.setItem("seconds", seconds)
      var counter = document.getElementById("quiz-time-left");
      var current_minutes = parseInt(seconds/60);
      var current_seconds = seconds % 60;
      counter.innerHTML = current_minutes + ":" + (current_seconds < 10 ? "0" : "") + current_seconds;
      if( seconds > 0 ) {
        setTimeout(tick, 1000);
      } 
      if(seconds == 0){
      document.getElementById("finish").click();
      document.getElementById("submitbtn").click();
    }
    }
    tick();

  
  }
  @foreach($exams as $exam)
  countdown({{$exam->time}});
  @endforeach           
                  </script>
             
             
             
             
            
  
 
          <script src="{{ asset('js/app.js') }}"></script>
          <script type="text/javascript">
              $(document).ready(function(){
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
              });
      
              $('.ansform').on('submit',function(e){
                  var form = $(this);
                  var submit = form.find("[type=submit]");
                  var submitOriginalText = submit.attr("value");
      
                  e.preventDefault();
                  var data = form.serialize();
                  var url = form.attr('action');
                  var post = form.attr('method');
                  $.ajax({
                      type : post,
                      url : url,
                      data :data,
                      success:function(data){
                         submit.attr("value", "Submitted");
                      },
                      beforeSend: function(){
                         submit.attr("value", "Loading...");
                         submit.prop("disabled", true);
                      },
                      error: function() {
                          submit.attr("value", submitOriginalText);
                          submit.prop("disabled", false);
                         // show error to end user
                      }
                  })
              })
          </script>


          @yield('script')  
        
      
    
      

@endsection

            

    
                
  
        
        

   

            

    
                
  