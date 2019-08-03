


@extends('layouts.user')




@section('content')

<style>
      #profile_pic
      {
        display:block;
    margin:auto;
      }
        </style>



<div class="container" id="view">
        <div class="page-title">Student Profile</div>
                <div class="col-lg-4">
                              
                <div class="profile-sidebar">
                <div class="card card-topline-aqua">
                <div class="card-body no-padding height-9">
                <div class="row">
                <div class="profile-userpic">
                         @foreach($profiles as $profile)                            
                            <img src="/storage/images/{{$profile->profile_pic}}" class="rounded-circle" id="profile_pic"  height="100%" width="50%"> </div>
                         @endforeach
                </div>
                                                        
                         <div class="profile-usertitle">
                        <div class="profile-usertitle-name">{{$profile = Auth::user()->name}} </div>
                        </div>
                        
                                 <ul class="list-group list-group-unbordered">
                                 <li class="list-group-item">
                                         <b>Year and Section:</b> @foreach($class_students as $class_student)<a class="pull-right">{{$class_student->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section}}</a>      @endforeach 
                                 </li>
                           
                                 <li class="list-group-item">
                                         <b>Section Name:</b>  @foreach($class_students as $class_student)<a class="pull-right">{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section_name}}</a>      @endforeach 
                                        </li>
                                 <li class="list-group-item">
                                         <b>School Year:</b> <a class="pull-right">11,172</a>
                                 </li>
                                
                                </ul>
                               
                        <div class="profile-userbuttons">
                                                                           
                   
                        @foreach($profiles as $profile)  
                        <a href="profile/{{$profile->id}}/edit" class="btn btn-default" id="edit">   EDIT</a>
                        @endforeach
                        </div>
                                                      
                 </div>
                </div>
        
                          <div class="card">
                        <div class="card-head card-topline-aqua">
                                <div class="page-title">About Me</div>
                        </div>
                        <div class="card-body no-padding height-9">
                             
                                   
                                        <ul class="list-group list-group-unbordered">
                                         <li class="list-group-item">        
                                        <b>Gender </b>
                                        <div class="profile-desc-item pull-right">{{$profile->gender}}</div>
                                        </li>
                                        <li class="list-group-item">
                                                <b>Email </b>
                                        <div class="profile-desc-item pull-right">{{$profile = Auth::user()->email}}</div>
                                   
                                        </li>
                                        
                                        <li class="list-group-item">
                                                <b>Birthday </b>
                                                @foreach($profiles as $profile)
                                        <div class="profile-desc-item pull-right">{{$profile->bday}}   </div>
                                        @endforeach
                                        </li>
                                        <li class="list-group-item">
                                                <b>Age </b>
                                                @foreach($profiles as $profile)
                                        <div class="profile-desc-item pull-right">{{$profile ->age}}   </div>
                                        @endforeach
                                        </li>
                                        <li class="list-group-item">
                                                <b>Address</b>
                                                @foreach($profiles as $profile)
                                        <div class="profile-desc-item pull-right">{{$profile->address}}  </div> @endforeach
                                        </li>
                                                       
                                                        
                                                        </div>
                                                </div>

                                </div>
                </div>


                <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div id="biography">
                                                <div class="row">
                                                  
                                                        <div class="col-md-3 col-6 b-r"> <strong>Name</strong>
                                                                <br>     
                                                              
                                                                <p class="text-muted">{{$profile = Auth::user()->name}}</p>
                                                        </div>
                                                      

                                                       
                                                        <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                                                <br>
                                                                @foreach($profiles as $profile)
                                                                <p class="text-muted">{{$profile->cp_no}}</p>@endforeach
                                                        </div>
                                                        <div class="col-md-3 col-6 b-r"> <strong>Telephone</strong>
                                                                <br>
                                                                @foreach($profiles as $profile)
                                                                <p class="text-muted">{{$profile->phone_no}}</p>@endforeach
                                                        </div>
                                                    
                                                        
                                                </div>
                                                <hr>
                                                @foreach($profiles as $profile)
                                                <p>{{$profile->bio}}</p>
                                                @endforeach
                                                <br><br>
                                                
                                                <hr>
                                                
                                        </div>
                                </div>
                </div>

</div>




        
@endsection

            

    
                
  