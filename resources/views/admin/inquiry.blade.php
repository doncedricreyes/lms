@extends('layouts.user')
<style>
    #searchbar{
     
      display: block;
    text-align: center;
    }
   #search{
     position: relative;
     left: 37%;
   }

         .mdl-data-table th, td{
  text-align: left !important;
  font-size: 16px;
}
#head {
  background-color:#488cc7;
  text-align: center !important;
  font-size: 28px;
  color: white;
}
#table{
  background-color:snow;
}
  </style>
@section('content')

    <div class="container" id="view">
          
            <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                  </div> <!-- end .flash-message -->
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                <div class="container">
                    <div class="row">
     
                        
                        
                           <div  class="col-lg-12 col-md-offset-0">
                        <div id="table" class="panel panel-default">
                            <div class="panel-heading" id="head">Inquiry</div>
                            <br>
                            
                       <div  class="panel-body"> 
                        <div  class="table-responsive">
                
                                
                          <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                   
                                        <th style="font-size:16px;">Name</th>
                                        <th style="font-size:16px;">Email</th>
                                        <th style="font-size:16px;">Subject</th>
                                        <th style="font-size:16px;">Message</th>  
                            
                                        <th style="font-size:16px;">Time</th>
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($inquiry as $row)
                            <tr>
                                <td>{{$loop->iteration}}. {{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->subject}}</td>
                                <td>{{$row->message}}</td>
                                <td>{{$row->created_at}}</td>
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>
                       </div>
                        </div>
                           </div></div>






    </div>
@endsection
