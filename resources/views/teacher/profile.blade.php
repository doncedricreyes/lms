



@extends('layouts.user')




@section('content')

<style>
      #profile_pic
      {
        display:block;
    margin:auto;
      }
      #subject
      {
        position: relative;
        width:65%;
        float:right;
      }
      #edit{
        position: relative;
        float: right;
      }
        </style>


<div class="container" id="view">

                <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                  @if(Session::has('alert-' . $msg))
                            
                                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                  @endif
                                @endforeach
                              </div> <!-- end .flash-message -->
                              
                              @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                          <section class="content">

                                <div class="row">
                                  <div class="col-md-4">
                                    <!-- Profile Image -->
                                    <div class="box box-primary">
                                      <div class="box-body box-profile">
                                          @if($profiles->get(0)->teacher_id == Auth::user()->id )
                                            @foreach($profiles as $profile)  
                                            <a href=""  data-toggle="modal" data-target="#profile"> <img src="/storage/images/{{$profile->profile_pic}}" class="profile-user-img img-responsive img-circle"id="profile_pic"  height="100%" width="50%"> </a>
                                     @endforeach
                                     @endif
                                     @if($profiles->get(0)->teacher_id != Auth::user()->id )
                                     @foreach($profiles as $profile) 
                                     <img src="/storage/images/{{$profile->profile_pic}}" class="profile-user-img img-responsive img-circle"id="profile_pic"  height="100%" width="50%">
                                     @endforeach 
                                     @endif
                                        <h3 class="profile-username text-center">{{$profiles->get(0)->teachers->name}}</h3>
                          
                          
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item">
                                            <b>Cellphone Number:</b>  <a class="pull-right">{{$profiles->get(0)->phone_no}}</a>  
                                          </li>
                                          <li class="list-group-item">
                                            <b>Telephone Number:</b> <a class="pull-right">{{$profiles->get(0)->cp_no}}</a>
                                          </li>
                                   
                                        </ul>
                          
                                        @if($profiles->get(0)->teacher_id == Auth::user()->id )
                                        @foreach($profiles as $profile)  
                                        <a href="{{$profile->id}}/edit" class="btn btn-default" id="edit">   EDIT</a>
                                        @endforeach 
                                                    @endif  
                                                    @if($profiles->get(0)->teacher_id != Auth::user()->id )
                                                        @if(Auth::user()->role == 'teacher')
                                                    @foreach($profiles as $profile)  
                                                    <a href="/teacher/{{$profile->teacher_id}}/message" class="btn btn-default" id="message">   Message</a>
                                                    @endforeach 
                                                    @endif
                                                                @endif  
                                                    @if (\Route::current()->getName() == 'student.teacher.profile') 
                                                    @foreach($profiles as $profile)  
                                                    <a href="/student/teachers/{{$profile->teacher_id}}/message" class="btn btn-default" id="message">   Message</a>
                                                 @endforeach
                                                    @endif    
                                                    @if (\Route::current()->getName() == 'parent.teacher.profile') 
                                                    @foreach($profiles as $profile)  
                                                    <a href="/parent/teachers/{{$profile->teacher_id}}/message" class="btn btn-default" id="message">   Message</a>
                                                 @endforeach
                                                    @endif  
                                  
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                          
                                    <!-- About Me Box -->
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">About Me</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body">
                                  
                                            <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                      <b>Gender:</b><a class="pull-right">{{$profile->gender}}</a>     
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Email:</b> <a class="pull-right">{{$profiles->get(0)->teachers->email}}</a>   
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Birthday:</b> <a class="pull-right">{{$profile->bday}} </a>  
                                                    </li>
                                                    <li class="list-group-item">
                                                            <b>Age:</b><a class="pull-right">{{$profile->age}} </a>  
                                                          </li>
                                                          <li class="list-group-item">
                                                                <b>Address:</b> <a class="pull-right">{{$profile->address}} </a>   
                                                              </li>
                                                             
                                                  </ul>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="jumbotron jumbotron-fluid">
                                                @foreach($profiles as $profile)
                                                <p class="lead">{{$profile->bio}}</p>
                                                @endforeach

                                    </div>
                                 
                                       
                                  <div class="col-xl-2">
                                      <div id="family" class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                        
                                          <div class="mdl-tabs__tab-bar">
                                             
                                              <a href="#class-panel" class="mdl-tabs__tab">Classes</a>
                                          
                                          </div>
                                      <br><br>
                                          <div class="mdl-tabs__panel is-active" id="class-panel">
                                                        @foreach($class_subject_teachers as $id)
                                                        <div id="subject" class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material">
                                                                        <div class="mdl-card__title">
                                                                                <h2 class="mdl-card__title-text"><a href="/teacher/subjects/{{$id->id}}">{{$id->subjects->get(0)->title}}</h2></a>
                                                                        </div>
                                                        
                                                                        <div class="mdl-card__actions mdl-card--border">
                                                                                        <h6>Schedule: {{$id->schedule}} </h6>
                                                                                        <h6>Year and Section: {{$id->classes->get(0)->year}}-{{$id->classes->get(0)->section}}</h6>
                                                                                        <h6>Section Name: {{$id->classes->get(0)->section_name}} </h6>
                                                                                        <h6>School Year: {{$id->classes->get(0)->school_year}}</h6>
                                                                        </div>
                                                                        <div class="mdl-card__menu">
                                                                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                                                                <i class="mdi mdi-share-variant"></i>
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                @endforeach
                                                                      </div>
                                                             
                                                                  </div>
                                  <!-- /.col --></div>
                                                                </div>        
                
                                <!-- /.row -->
                          
                              </section>
                                <!-- /.box-body -->







                                <!-- Modal --> @foreach($profiles as $id)   
 <form action = "{{route('teacher.profile_pic.update',$id->id)}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
    @endforeach
    <input name="_method" type="hidden" value="PUT">
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="profile" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profile">Change Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
        
              <input class="mdl-textfield__input" type="file" name="profile_pic" id="profile_pic" >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Upload">
      </div>
    </div>
  </div>
</div>
</form>
</div>

        
@endsection

            

    
                
  

