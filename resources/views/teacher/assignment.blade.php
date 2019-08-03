


   


@extends('layouts.user')

@section('content')
<style>
        #submit{
                position: relative;
                float:right;
        }
        </style>
<div class="container" id="view">
 
        @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    
        <legend>Create Assignment</legend>
     

          
        
                  
        @foreach($class_subject_teachers as $id)
        <form action = "{{route('assignment.store',$id->id)}}" method="post">
                {{csrf_field() }}
                @endforeach

                
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
                        <input class="mdl-textfield__input" type="datetime-local"   id="date_start" name="date_start">
                        <label class="mdl-textfield__label">Date Start</label>
                    </div>
        </div>
    <div class="col-lg-6 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input class="mdl-textfield__input" type="datetime-local"  id="date_end" name="date_end">
                        <label class="mdl-textfield__label">Date End:</label>
                    </div>
        </div>

        <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
         
                    <input class="mdl-textfield__input" type="text"   id="title" name="title">
           
                    <label class="mdl-textfield__label">Title</label>
                </div>
                
            </div>
        
            <div class="col-lg-12 p-t-20">
                    <div style="width:100%" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
             
                            <textarea class="mdl-textfield__input" type="text" rows= "7"  id="description" name="description"></textarea>
               
                        <label class="mdl-textfield__label">Question:</label>
                    </div>
                    
                </div>
  
                <div class="col-lg-12 p-t-20">
            <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Create
               </button>
                </div>
        </form>
     
</div>
@endsection

            

    
                
  
        
        

   

            

    
                
  