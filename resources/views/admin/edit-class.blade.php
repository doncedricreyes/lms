


    @extends('layouts.user')

    @section('content')
        
    
                       
                        
                        <div class="container" id ="add">
                            <form action = "{{route('add-class.store')}}" method="post">
                                {{csrf_field() }}
                             
                               
                               <h1> {{$classes->year_and_section}} </h1>
        
                               <h1> {{$classes->adviser_id }} </h1>
                          
                                
    
            
                                
                                                            
    @foreach($classes->subjects as $subject)                          
    <label for="subject">Subject:</label>
                                          
   
    <select class="form-control select2-multi" name="subjects[]" multiple="multiple" id="subject">
      
            <option >{{ $subject->title }}</option>
      
    
    </select>
     
     
    @endforeach
      <input type="submit" class="btn btn-primary" value="Submit Information">
    
    </div>
                                
                                  
        @endsection
    
    
    
    