@extends('layouts.user')

@section('content')

    <div class="container" id="view">
        <div class="container">
            <div class="row">
                
                
                <div class="col-md-12">
                <legend>Class List</legend>
    
                <div class="table-responsive">
        
                        
                      <table id="mytable" class="table table-bordred table-striped">
                           
                           <thead>
                           
                                <th>Student's Name</th>
                                <th> <a href="{{route('class_list.excel',$class_subject_teachers->class_id)}}"class="btn btn-primary btn-xs">Export to Excel</a></th>
                                
                           </thead>
            <tbody>
                    <?php $i=1  ?>
                    @foreach($class_students as $class)
                    <tr>
                        
                            <td>{{$i}}. {{$class->students->get(0)->name}}</td>
                            <?php $i++ ?>
                            
    
        </tr>
            @endforeach
     
           
            
            </tbody>
                
        </table>
    </div> 
      
</div>

    </div>
@endsection