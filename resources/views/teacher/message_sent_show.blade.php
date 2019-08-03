

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
</style>

@section('content')




@if(Auth::user()->role == 'teacher')
@if($messages->get(0)->sender_teacher_id == Auth::user()->id)
<div class="container" id="view">
           
            <div class="row" id="inbox">
                        
                        
                    <div class="col-xl-12" >
                    <legend>{{$messages->get(0)->message_title}}</legend>
           
                    <div style="width:100%" class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material">
                        <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">    <h5> To: 
                                                {{$admins->get(0)->name}}
                                                {{$students->get(0)->name}}
                                                {{$teachers->get(0)->name}}
                                                {{$parents->get(0)->name}}
                                            <br>
                                            {{$messages->get(0)->created_at}}</h5></h2>
                        </div>
                
                        <div class="mdl-card__actions mdl-card--border" >
                                <h5>{{$messages->get(0)->message_body}}</h5>
                                     
                                       
                        </div>
                        <div class="mdl-card__menu">
                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                <i class="mdi mdi-share-variant"></i>
                                </button>
                        </div>
                </div>

              
</div>
                    </div>
            </div>
            

@endif
@endif


@endsection

            

    
                
  