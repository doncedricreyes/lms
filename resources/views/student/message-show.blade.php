

@extends('layouts.user')

<style>
    #inbox{
        position: absolute;
        top: 10%;
        left: 20%;
        width: 80%;
    }
    #nav{
        position: absolute;
        top: 10%;
        right: 25%;
        width: 80%;
    }
    #reply{
           
            left: 90%;
    }
</style>

@section('content')





<div class="container" id="view">
        @if(Auth::user()->role == 'student')
        @if($messages->get(0)->recipient_student_id == Auth::user()->id)
            <div class="row" id="inbox">
                        
                        
                    <div class="col-xl-12" >
                    <legend>{{$messages->get(0)->message_title}}</legend>
                    <div style="width:100%" class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material">
                                <div class="mdl-card__title">
                                        <h2 class="mdl-card__title-text">    <h5> From: 
                                                        @foreach($messages as $message)
                                                        {{$message->students['name']}} 
                                                            {{$message->parents['name']}}
                                                            {{$message->teachers['name']}}
                                                            {{$message->admins['name']}} 
                                                    @endforeach
                                                    <br>
                                                    {{$messages->get(0)->created_at}}</h5></h2>
                                </div>
                        
                                <div class="mdl-card__actions mdl-card--border" >
                                                <h5>{{$messages->get(0)->message_body}}</h5>
                                             
                                             @foreach($messages as $message)
                                                 @if($message->admins['name'] = null)
                                                <a id="reply" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$messages->get(0)->id}}/reply"><i  class="material-icons">
                                                                reply
                                                                </i></a>
                                                 @endif
                                                 @endforeach
                                </div>
                                <div class="mdl-card__menu">
                                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                        <i class="mdi mdi-share-variant"></i>
                                        </button>
                                </div>
                        </div>
                                
             
<br>
               

              
</div>
                    </div>
            </div>
            @endif
            @endif

</div>


@endsection

            

    
                
  
