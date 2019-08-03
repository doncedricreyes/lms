@extends('layouts.user')

<style>
        #submit{
            position: relative;
            left: 70%;
        }
    </style>
@section('content')
<div class="container" id ="add">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action = "{{route('parent.enrollment.store')}}" method="post" enctype="multipart/form-data">
                                          
                  {{csrf_field() }}
                  
              
                
                  <div class="form-group">
                      <label>Adviser:</label>
                      <select class="form-control select2" id="adviser" name="adviser" style="width: 100%;">
                
                              @foreach($teachers as $teacher)
                              <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                           @endforeach
                      </select>
                    </div>
                  <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                        <input class="mdl-textfield__input" type="number"   id="year" name="year">
               
                        <label class="mdl-textfield__label">Year:</label>
                    </div>
                    
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
           
                      <input class="mdl-textfield__input" type="number"   id="section" name="section">
             
                      <label class="mdl-textfield__label">Section:</label>
                  </div>
                  
              </div>
              <div class="col-lg-6 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text"   id="school_year" name="school_year">
           
                    <label class="mdl-textfield__label">School Year:</label>
                </div>
                
            </div>

              <div class="col-lg-6 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text"   id="section_name" name="section_name">
           
                    <label class="mdl-textfield__label">Section Name:</label>
                </div>
                
            </div>

     
          <div class="col-lg-6 p-t-20">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
     
                <input class="mdl-textfield__input" type="text"   id="student" name="student">
       
                <label class="mdl-textfield__label">Student Name:</label>
            </div>
            
        </div>

          <div class="col-lg-6 p-t-20">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
     
                <input class="mdl-textfield__input" type="text"   id="parent_key" name="parent_key">
       
                <label class="mdl-textfield__label">Enrollment Key:</label>
            </div>
            
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Enroll</button> 
                  
          
                 
               
              </form>
</div>
    @endsection