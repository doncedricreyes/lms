


    @extends('layouts.user')

    @section('content')
        
    
    @foreach($classes as $class)       
                    
                        <div class="container" id ="add">
                            <form action = "{{route('addsubjtoclass.store',$class->id)}}" method="post" enctype="multipart/form-data">
                                
                                {{csrf_field() }}
                 
                           
        <div style='display:none'>
                              
                 
                            
    <select class="custom-select custom-select-lg mb-3" name="year_and_section" id="year_and_section">
        
       
            <option value="{!! $class->year_and_section !!}"> {!! $class->year_and_section !!}</option>
         @endforeach
                                        </select>


                                                
                                               
                            </div>
                              
                      
  
      <input type="submit" class="btn btn-primary" value="Submit Information">
    
    </div>
                                
                                  
        @endsection
    










        
    
    
    