@extends('layouts.user')

@section('content')
<style>
  #submit{
      position: relative;
      float:left;  

  }
    </style>
<div class="container" id ="add">
        @if(session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif
                <form action = "{{route('class.student.store')}}" method="post" enctype="multipart/form-data">
                                          
                  {{csrf_field() }}
                  
              
                  <div class="form-group">
                    <label>Adviser</label>
                    <select class="form-control select2" name="adviser" id="adviser" style="width: 100%;">
                        @foreach($teachers as $teacher)
                        <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                     @endforeach
                    </select>
                  </div>
                 
                  <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                        <input class="mdl-textfield__input" type="text"   id="year" name="year">
               
                        <label class="mdl-textfield__label">Year:</label>
                    </div>
                    
                </div>
                <div class="col-lg-6 p-t-20">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
           
                      <input class="mdl-textfield__input" type="text"   id="section" name="section">
             
                      <label class="mdl-textfield__label">Section:</label>
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
     
                <input class="mdl-textfield__input" type="text"   id="enrollment_key" name="enrollment_key">
       
                <label class="mdl-textfield__label">Enrollment Key:</label>
            </div>
            
        </div>
        <div class="col-lg-6 p-t-20">
        <button type="submit" id="submit"  class="btn btn-primary">Enroll</button> 
    </div>
          
                 
               
              </form>
</div>
    @endsection