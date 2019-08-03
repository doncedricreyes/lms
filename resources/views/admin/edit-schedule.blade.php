

    @extends('layouts.user')

    @section('content')
        
    
                       
                        
                        <div class="container" id ="add">

@foreach($classes as $class)
<form action = "{{route('addsubjtoclass.edit',$class->id)}}" method="post" enctype="multipart/form-data">
                          
  {{csrf_field() }}
  <input name="_method" type="hidden" value="PUT">
  @endforeach
<div class="modal-body">

 
  <div class="form-group">
     @foreach($classes as $class)
      <input type="hidden" name="class_id" id="class_id" class="form-control" value="{{$class->id}}"> 
   
  </div>
  @endforeach
         <div class="form-group">
          <label for="subject">Subject:</label>
                                
          <select class="custom-select custom-select-lg mb-3" name="subject_id" id="subject_id">
              @foreach($subjects as $subject)
                  <option value='{{ $subject->id }}'>{{ $subject->title }}</option>
              @endforeach
          
          </select>
      <label for="teacher_id">Teacher:</label>
      <select class="custom-select custom-select-lg mb-3" name="teacher_id" id="teacher_id">
  
          @foreach($teachers as $teacher)
          <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
          @endforeach
  </select>
  <label for="schedule">Schedule</label>
  <input type="text" name="schedule" id="schedule" class="form-control" placeholder="Days/Time start/Time end"> 
<input type="submit" value="submit">

</div>

 
</form>
                        </div>
                    @endsection