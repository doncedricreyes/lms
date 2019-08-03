


   


@extends('layouts.user')

@section('content')

<div class="container" id="view">
 
  
     <style>
         #submit{
             position: relative;
             float: left;
      }
         </style>

     
            <legend>Edit Profile</legend>

             @foreach($teacher_profiles as $profile)
                    <form action = "{{route('teacher.profile.update', $profile->id)}}" method="post" enctype="multipart/form-data">
                        @endforeach
                        {{csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
            
                  
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input"  type="text" value="{{$profile = Auth::user()->name}}" readonly>
                                                                        <label class="mdl-textfield__label">Name</label>
                                                                    </div>
                                                                </div>
                                                             
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="email" value="{{$profile = Auth::user()->email}}" id="email" Name="email">
                                                                        <label class="mdl-textfield__label">Email</label>
                                                                        <span class="mdl-textfield__error">Enter Valid Email Address!</span>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="date" value="{{ $teacher_profiles->get(0)->bday }}"  id="bday" name="bday">
                                                                            <label class="mdl-textfield__label">Birthday</label>
                                                                        </div>
                                                            </div>

                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                             
                                                                        <input class="mdl-textfield__input" type="text" value="{{ $teacher_profiles->get(0)->age }}"  id="age" name="age"readonly>
                                                               
                                                                        <label class="mdl-textfield__label">Age</label>
                                                                    </div>
                                                                    
                                                                </div>
                                                             
                                                        
                                                                <div class="col-lg-3 p-t-20">
                                                                        <div class="form-group">
                                                                                <label for="gender">Gender:</label>
                                                                                <select class="form-control" id="gender" name="gender">
                                                                                  <option>Male</option>
                                                                                  <option>Female</option>
                                                                                  <option>Others</option>
                                                                                </select>
                                                                              </div>
                                                                </div>
                                                                <div class="col-lg-12 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="text" value="{{$teacher_profiles->get(0)->address}}" id="address" name="address">
                                                                            <label class="mdl-textfield__label">Address</label>
                                                                        </div>
                                                            </div>
                                                            <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="text" value="{{$teacher_profiles->get(0)->phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="phone_no" name="phone_no">
                                                                        <label class="mdl-textfield__label" for="text5">Phone Number</label>
                                                                        <span class="mdl-textfield__error">Number required!</span>
                                                                    </div>
                                                                </div>
                                                            <div class="col-lg-6 p-t-20">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <input class="mdl-textfield__input" type="text" value="{{$teacher_profiles->get(0)->cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="cp_no" name="cp_no">
                                                                    <label class="mdl-textfield__label" for="text5">Mobile Number</label>
                                                                    <span class="mdl-textfield__error">Number required!</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <label class="mdl-textfield__label" >Add a bio here...</label>
                                                                        <textarea class="mdl-textfield__input" type="text" rows= "7"  id="bio" name="bio">{{$teacher_profiles->get(0)->bio}}</textarea>
                                                
                                                                                    </div>
                                                                                </div>
                            
                                                                            
                                                                        
                                                                                <div class="col-lg-6 p-t-20">
                                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                                        <button id="submit" type="submit" class="btn btn-primary">Save changes</button> 
                                                                                        </div>
                                                                                        <br><br><br>
                                                                            </div>
                                                                                </form>
                                                    </div>
                                                    
                                             
                                                   
                                                   
                                              
                                                                            
</div>              
      
            <!-- Password -->
    
     
    
@endsection

            

    
                
  
        
        

   

            

    
                
  