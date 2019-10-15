@extends('layouts.user')

@section('content')
<style>
    .demo-card-wide.mdl-card {
      width: 100%;
    }
    .demo-card-wide {
     
      height: 200%;
     
    }
  
    #searchbar{
     
     display: block;
   text-align: center;
   }
  #search{
    position: relative;
    left: 37%;
  }

        .mdl-data-table th, td{
 text-align: left !important;
 font-size: 16px;
}
#head {
 background-color:#488cc7;
 text-align: center !important;
 font-size: 24px;
 color: white;
}
#table{
 background-color:snow;
 position: relative;
 width:90%;
 left: 5%;
}
 
 
    </style>

<div class="container" id ="view">


         <legend><h1>Subjects</h1></legend>
                  @foreach($class_students as $subject)
                  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title" style=" background-color:#488cc7;">
                      <h2 class="mdl-card__title-text" > 
                        <a href="class/{{$subject->class_subject_teacher_id}}" ><h3 style="font-size:28px; color:white;">{{$subject->class_subject_teachers->get(0)->subjects->get(0)->title}}</h3></a>
                                       </h2>
                    </div>
                
                    <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
                      <div class="mdl-card__supporting-text">
                            <a href="teachers/profile/{{$subject->class_subject_teachers->get(0)->teachers->get(0)->id}}" > <h5>Teacher: {{$subject->class_subject_teachers->get(0)->teachers->get(0)->name}}</h5></a>
                        <h5 style="font-size:16px;">Year and Section: {{$subject->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$subject->class_subject_teachers->get(0)->classes->get(0)->section}}</h5>
                        <h5 style="font-size:16px;">Section Name: {{$subject->class_subject_teachers->get(0)->classes->get(0)->section_name}} </h5>
                        <h5 style="font-size:16px;">School year: {{$subject->class_subject_teachers->get(0)->classes->get(0)->school_year}}</h5>
                        <h5 style="font-size:16px;">Schedule: {{$subject->class_subject_teachers->get(0)->schedule}}</h5>
                      </div>
                    </div>
                  </div>
               <br><br>
                      @endforeach
                </div>
@endsection
