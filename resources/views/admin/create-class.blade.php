


    @extends('layouts.user')

@section('content')
    

                   
                    
                    <div class="container" id ="add">
                        <form action = "{{route('add-class.store')}}" method="post">
                            {{csrf_field() }}
                       
    
                            <label for="year"> Year: </label>
                            <input type="text" name="year" id="year"> 
                            <label for="section"> Section: </label>
                            <input type="text" name="section" id="section"> 
                            <label for="section_name"> Section Name: </label>
                            <input type="text" name="section_name" id="section_name"><br>
                            <label for="enrollment_key"> Enrollment Key: </label>
                            <input type="text" name="enrollment_key" id="enrollment_key"><br>
                            <label for="parent_key">Parent Enrollment Key: </label>
                            <input type="text" name="parent_key" id="parent_key"><br>
                            <label for="school_year"> School Year: </label>
                            <input type="text" name="school_year" id="school_year"><br>
                            <label for= "adviser">Adviser: </label>
                            <select class="custom-select custom-select-lg mb-3" name="adviser" id="adviser">
                                  
        
                                @foreach($teachers as $teacher)
                                <option value="{!! $teacher->id !!}"> {!! $teacher->name !!}</option>
                             @endforeach
                                                            </select>

 
 

  <input type="submit" class="btn btn-primary" value="Submit Information">

</div>
                            
                              
    @endsection



