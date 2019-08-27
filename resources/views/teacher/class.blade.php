@extends('layouts.user')

@section('content')
<style>
    .demo-card-wide.mdl-card {
      width: 100%;
    }
    .demo-card-wide {
     
      height: 200%;
     
    }
  
    </style>
<div class="container" id ="view">

    @foreach ($class_subject_teachers as $item)
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text">  
            <a href="subjects/{{$item->id}}"><h1 class="mdl-card__title-text">{{$item->subjects->get(0)->title}}</h1> </a></h2>
        </div>
    
        <div class="mdl-card__actions mdl-card--border">
          <div class="mdl-card__supporting-text">
           
              <p>Year and Section: {{$item->classes->get(0)->year}}-{{$item->classes->get(0)->section}}</p>
              <p>Section Name: {{$item->classes->get(0)->section_name}}</p>
              <p>Schedule: {{$item->schedule}}</p>
         
          </div>
        </div>
      </div>
      <br>
      @endforeach
      
                 

      
                
              </div>
              
         
@endsection
