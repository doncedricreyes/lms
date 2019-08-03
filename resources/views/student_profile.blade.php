



@extends('layouts.user')




@section('content')

<style>
      #profile_pic
      {
        display:block;
    margin:auto;
      }
      #family
      {
    
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
                                          @if($students->get(0)->id == Auth::user()->id )
                                            @foreach($profiles as $profile)  
                                            <a href=""  data-toggle="modal" data-target="#profile"> <img src="/storage/images/{{$profile->profile_pic}}" class="profile-user-img img-responsive img-circle"id="profile_pic"  height="100%" width="50%"> </a>
                                     @endforeach
                                     @endif
                                     @if($students->get(0)->id != Auth::user()->id )
                                     @foreach($profiles as $profile)  
                                    <img src="/storage/images/{{$profile->profile_pic}}" class="profile-user-img img-responsive img-circle"id="profile_pic"  height="100%" width="50%">
                              @endforeach
                              @endif
                                        <h3 class="profile-username text-center">{{$students->get(0)->name}}</h3>
                          
                          
                                        <ul class="list-group list-group-unbordered">
                                          <li class="list-group-item">
                                            <b>Year and Section:</b>  @foreach($class_students as $class_student)<a class="pull-right">{{$class_student->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section}}</a>      @endforeach 
                                          </li>
                                          <li class="list-group-item">
                                            <b>Section Name:</b>  @foreach($class_students as $class_student)<a class="pull-right">{{$class_student->class_subject_teachers->get(0)->classes->get(0)->section_name}}</a>      @endforeach 
                                          </li>
                                          <li class="list-group-item">
                                            <b>School Year:</b> @foreach($class_students as $class_student) <a class="pull-right">{{$class_student->class_subject_teachers->get(0)->classes->get(0)->school_year}}</a>      @endforeach
                                          </li>
                                        </ul>
                          
                                        @if (\Route::current()->getName() == 'teacher.student.profile') 
                                        <a href="/teacher/student/{{$profile->student_id}}/message" class="btn btn-primary btn-block" id="message">   Message</a>
                                        <a href="/teacher/parent/{{$class_students->get(0)->parent_id}}/message" class="btn btn-primary btn-block" id="message">   Message Parent</a>
                                        @endif
                                        @if (\Route::current()->getName() == 'parent.student.profile') 
                                        <a href="/parent/students/{{$profile->student_id}}/message" class="btn btn-primary btn-block" id="message">   Message</a>
                                        @endif
                    @if($students->get(0)->id == Auth::user()->id )
                        @foreach($profiles as $profile)  
                        <a href="{{$profile->id}}/edit" class="btn btn-primary btn-block" id="edit">   EDIT</a>
                        @endforeach                                        
           @endif
           @if($students->get(0)->id != Auth::user()->id )
           @if (\Route::current()->getName() == 'student.profile') 
           @foreach($profiles as $profile)  
           <a href="/student/{{$profile->student_id}}/message" class="btn btn-primary btn-block" id="message">   Message</a>
          
           @endforeach                                        
@endif
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
                                                      <b>Email:</b> <a class="pull-right">{{$students->get(0)->email}}</a>   
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
                                                              <li class="list-group-item">
                                                                  <b>CP No. :</b> <a class="pull-right">{{$profile->cp_no}} </a>   
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Phone No. :</b> <a class="pull-right">{{$profile->phone_no}} </a>   
                                                                  </li>
                                                  </ul>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="jumbotron jumbotron-fluid">
                         
                                        <p class="lead">{{$profile->bio}}</p>
                           
                                    </div>
                                 
                                       
                                  <div class="col-xl-2">
                                      <div id="family" class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                        
                                          <div class="mdl-tabs__tab-bar">
                                             
                                              <a href="#family-panel" class="mdl-tabs__tab">Family Background</a>
                                          
                                          </div>
                                      <br><br>
                                          <div class="mdl-tabs__panel is-active" id="family-panel">
                                                          @foreach($profiles as $profile)
                                                          <div class="col-md-4 p-t-20">
                                                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                  <input class="mdl-textfield__input" type="text" value="{{$profile->father_name}}" id="father_name" name="father_name" readonly>
                                                                  <label class="mdl-textfield__label">Father Name</label>
                                                              </div>
                                                          </div>
                          
                                                          <div class="col-md-4 p-t-20">
                                                                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                      <input class="mdl-textfield__input" type="email" value="{{$profile->father_email}}" id="father_email" Name="father_email"readonly>
                                                                      <label class="mdl-textfield__label">Father Email</label>
                                                                
                                                                  </div>
                                                              </div>
                                                          <div class="col-md-4 p-t-20">
                                                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                  <input class="mdl-textfield__input" type="text" value="{{$profile->father_cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="father_cp_no" name="father_cp_no"readonly>
                                                                  <label class="mdl-textfield__label" for="txtPNo">Father Mobile Number</label>
                                                                 
                                                              </div>
                                                          </div>
                                                          <div class="col-md-4 p-t-20">
                                                                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                      <input class="mdl-textfield__input" type="text" value="{{$profile->father_phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="father_phone_no" name="father_phone_no"readonly>
                                                                      <label class="mdl-textfield__label" for="txtPNo">Father Telephone Number</label>
                                                                      
                                                                  </div>
                                                              </div>
                                                            
                                                              <div class="col-md-4 p-t-20">
                                                                          <br><br>
                                                                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                          <input class="mdl-textfield__input" type="text" value="{{$profile->mother_name}}" id="mother_name" name="mother_name"readonly>
                                                                          <label class="mdl-textfield__label">Mother Name</label>
                                                                      </div>
                                                                  </div>
                                  
                                                                  <div class="col-md-4 p-t-20">
                                                                                  <br><br>
                                                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                              <input class="mdl-textfield__input" type="email" value="{{$profile->mother_email}}" id="mother_email" Name="mother_email"readonly>
                                                                              <label class="mdl-textfield__label">Mother Email</label>
                                                                         
                                                                          </div>
                                                                      </div>
                                                                  <div class="col-md-4 p-t-20">
                                                                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                          <input class="mdl-textfield__input" type="text" value="{{$profile->mother_cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="mother_cp_no" name="mother_cp_no"readonly>
                                                                          <label class="mdl-textfield__label" for="txtPNo">Mother Mobile Number</label>
                                                                    
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-4 p-t-20">
                                                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                              <input class="mdl-textfield__input" type="text" value="{{$profile->mother_phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="mother_phone_no" name="mother_phone_no"readonly>
                                                                              <label class="mdl-textfield__label" for="txtPNo">Mother Phone Number</label>
                                                                          
                                                                          </div>
                                                                      </div>
                                                                      @endforeach
                                                                  </div>
                                  <!-- /.col --></div>
                                                                </div>        
                
                                <!-- /.row -->
                          
                              </section>
                                <!-- /.box-body -->







                                <!-- Modal --> @foreach($profiles as $id)   
 <form action = "{{route('student.profile_pic.update',$id->id)}}" method="post"  enctype="multipart/form-data">
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

            

    
                
  

