


@extends('layouts.user')

@section('content')
    <div class="container" id="view">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Teachers</div>

                    <div class="panel-body">    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Password</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                              
                
          
                 
                <tr>
               
                 
                    
                    @foreach($profile as $profiles)
                    <td  contenteditable="true">{{$profiles->address}}</td>
                    <img src="/storage/images/{{$profiles->profile_pic}}">
                   
                    
                </tr>
            
                
                               

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
       
        @endforeach
       
           
        
    </div>
   
@endsection

            

    
                
  