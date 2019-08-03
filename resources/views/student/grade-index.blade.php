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
  @if($class_students != '[]')

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
      <h2 class="mdl-card__title-text"> 
       <h3><a href="/student/grades/{{$class_students->get(0)->class_subject_teachers->get(0)->class_id}}">
         Section: {{$class_students->get(0)->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$class_students->get(0)->class_subject_teachers->get(0)->classes->get(0)->section}}</h3>
                       </h2>
    </div>

    <div class="mdl-card__actions mdl-card--border">
      <div class="mdl-card__supporting-text">

          <p>Adviser: {{$class_subject_teachers->get(0)->classes->get(0)->teachers->get(0)->name}}</p>
          <p>Section Name: {{$class_subject_teachers->get(0)->classes->get(0)->section_name}}</p>
          <p>School Year: {{$class_subject_teachers->get(0)->classes->get(0)->school_year  }}</p>

      </div>
    </div>
  </div>
  @endif
</div>
@endsection