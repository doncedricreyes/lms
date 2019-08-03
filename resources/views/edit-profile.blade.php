


   


@extends('layouts.user')

@section('content')

<div class="container" id="view">
        <style>
                #submit{
                    position: relative;
                    float:left;
                }
                </style>
  
     
     
     
            <legend>Edit Profile</legend>
     
            <!-- Email -->
            <div class="card-body">
            <div class="form-group">
                  
                    @foreach($profiles as $profile)
                    <form action = "{{route('student.profile.update', $profile->id)}}" method="post" enctype="multipart/form-data">
                            @endforeach
                        {{csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        
                       
                               

                                                  
                                                   <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                                    <div class="mdl-tabs__tab-bar">
                                                        <a href="#basic-panel" class="mdl-tabs__tab is-active">Basic Information</a>
                                                        <a href="#family-panel" class="mdl-tabs__tab">Family Background</a>
                                                    
                                                    </div>
                                                <br><br>
                                                    <div class="mdl-tabs__panel is-active" id="basic-panel">
                                                       
                            
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="text" value="{{$profile = Auth::user()->name}}" readonly>
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
                                                              @foreach($profiles as $profile)
                                                              
                                                              
                                                              <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="date" value="{{ $profile->bday }}"  id="bday" name="bday">
                                                                            <label class="mdl-textfield__label">Birthday</label>
                                                                        </div>
                                                            </div>
                                                              
                                                              
                                                              
                                                              <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                             
                                                                        <input class="mdl-textfield__input" type="text" value="{{ $profile->age }}"  id="age" name="age"readonly>
                                                               
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
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="text" value="{{$profile->address}}" id="address" name="address">
                                                                            <label class="mdl-textfield__label">Address</label>
                                                                        </div>
                                                            </div>
                                                            <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="text" value="{{$profile->phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="phone_no" name="phone_no">
                                                                        <label class="mdl-textfield__label" for="text5">Phone Number</label>
                                                                        <span class="mdl-textfield__error">Number required!</span>
                                                                    </div>
                                                                </div>
                                                            <div class="col-lg-6 p-t-20">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <input class="mdl-textfield__input" type="text" value="{{$profile->cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="cp_no" name="cp_no">
                                                                    <label class="mdl-textfield__label" for="text5">Mobile Number</label>
                                                                    <span class="mdl-textfield__error">Number required!</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <label class="mdl-textfield__label" >Add a bio here...</label>
                                                                        <textarea class="mdl-textfield__input" type="text" rows= "7"  id="bio" name="bio">{{$profile->bio}}</textarea>
                                                
                                                                                    </div>
                                                                                </div>
                            
                                                                              @endforeach
                                                                           
                                                                              <div class="col-lg-6 p-t-20">
                                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                                        <button id="submit" type="submit" class="btn btn-primary">Save changes</button> 
                                                                                        </div>
                                                                                        <br><br><br>
                                                                            </div>
                                                    </div>
                                                    
                                                   
                                                   
                                                   
                                                     <div class="mdl-tabs__panel" id="family-panel">
                                                        @foreach($profiles as $profile)
                                                        <div class="col-lg-6 p-t-20">
                                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input class="mdl-textfield__input" type="text" value="{{$profile->father_name}}" id="father_name" name="father_name">
                                                                <label class="mdl-textfield__label">Father Name</label>
                                                            </div>
                                                        </div>
                        
                                                        <div class="col-lg-6 p-t-20">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <input class="mdl-textfield__input" type="email" value="{{$profile->father_email}}" id="father_email" Name="father_email">
                                                                    <label class="mdl-textfield__label">Father Email</label>
                                                                    <span class="mdl-textfield__error">Enter Valid Email Address!</span>
                                                                </div>
                                                            </div>
                                                        <div class="col-lg-6 p-t-20">
                                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input class="mdl-textfield__input" type="text" value="{{$profile->father_cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="father_cp_no" name="father_cp_no">
                                                                <label class="mdl-textfield__label" for="txtPNo">Father Mobile Number</label>
                                                                <span class="mdl-textfield__error">Number required!</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 p-t-20">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <input class="mdl-textfield__input" type="text" value="{{$profile->father_phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="father_phone_no" name="father_phone_no">
                                                                    <label class="mdl-textfield__label" for="txtPNo">Father Telephone Number</label>
                                                                    <span class="mdl-textfield__error">Number required!</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="text" value="{{$profile->mother_name}}" id="mother_name" name="mother_name">
                                                                        <label class="mdl-textfield__label">Mother Name</label>
                                                                    </div>
                                                                </div>
                                
                                                                <div class="col-lg-6 p-t-20">
                                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="email" value="{{$profile->mother_email}}" id="mother_email" Name="mother_email">
                                                                            <label class="mdl-textfield__label">Mother Email</label>
                                                                            <span class="mdl-textfield__error">Enter Valid Email Address!</span>
                                                                        </div>
                                                                    </div>
                                                                <div class="col-lg-6 p-t-20">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                        <input class="mdl-textfield__input" type="text" value="{{$profile->mother_cp_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="mother_cp_no" name="mother_cp_no">
                                                                        <label class="mdl-textfield__label" for="txtPNo">Mother Mobile Number</label>
                                                                        <span class="mdl-textfield__error">Number required!</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 p-t-20">
                                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                            <input class="mdl-textfield__input" type="text" value="{{$profile->mother_phone_no}}" pattern="-?[0-9]*(\.[0-9]+)?" id="mother_phone_no" name="mother_phone_no">
                                                                            <label class="mdl-textfield__label" for="txtPNo">Mother Phone Number</label>
                                                                            <span class="mdl-textfield__error">Number required!</span>
                                                                        </div>
                                                                    </div>
                        
                                                         
                                                                            
                                                    </div>
                                                    @endforeach
                                               

                                                    
                                                   </div>
           
                                                
                </div>
            </div>
            </div>
            <!-- Password -->
        </form>
     
    </div>
@endsection

            

    
                
  
        
        

   

            

    
                
  