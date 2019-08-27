


   


@extends('layouts.user')

@section('content')
<style>
                #submit{
                        position: relative;
                        left:90%;
                        
                }
                </style>
                @if($assignments->get(0)->class_subject_teachers->teacher_id == auth::user()->id)
<div class="container" id="view">
 
  
    
        <legend>Edit Assignment</legend>
     

          
        
                  
        @foreach($assignments as $id)
        <form action = "{{route('assignment.update',$id->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field() }}
         
                <input name="_method" type="hidden" value="PUT">
                

                
                <div class="form-group">
                                <label for="quarter">Quarter:</label>
                                <select class="form-control" name="quarter" id="quarter">
                                  <option value="1">1st Quarter</option>
                                  <option value="2">2nd Quarter</option>
                                  <option value="3">3rd Quarter</option>
                                  <option value="4">4th Quarter</option>
                                </select>
                              </div>
                              <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Date Start</label>
                                        <br>
                                                <input class="mdl-textfield__input" type="datetime-local"   id="date_start" name="date_start" value="{{$id->date_start}}">
                                                
                                            </div>
                                </div>
                            <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Date End:</label>
                                        <br>
                                                <input class="mdl-textfield__input" type="datetime-local"  id="date_end" name="date_end" value="{{$id->date_end}}">
                                                
                                            </div>
                                </div>
                        
                                <div class="col-lg-12 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 
                                            <input class="mdl-textfield__input" type="text"   id="title" name="title"value="{{$id->title}}">
                                   
                                            <label class="mdl-textfield__label">Title</label>
                                        </div>
                                        
                                    </div>
                                
                                    <div class="col-lg-12 p-t-20">
                                            <div style="width:100%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                     
                                                    <textarea class="mdl-textfield__input" type="text" rows= "7"  id="description" name="description">{{$id->description}}</textarea>
                                       
                                                <label class="mdl-textfield__label">Question:</label>
                                            </div>
                                            
                                        </div>
                          
                                        <div class="col-lg-12 p-t-20">
                                    <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                                            Update
                                       </button>
                                        </div>
                                </form>
        @endforeach
</div>
@endif
@endsection

            

    
                
  
        
        

   

            

    
                
  
