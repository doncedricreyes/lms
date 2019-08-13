

@extends('layouts.user')

<style>
                #inbox{
                    position: relative;
            
                    left: 2%;
                    width: 100%;
                }
            
            </style>
            

@section('content')


 



<div class="container" id="view">
    <div class="text-center">
        {{ $message_sender->links() }}
       
        </div>
                <section class="content">
                                <div class="row">
                                  <div class="col-md-3">
                                  <legend>Messages</legend>
                          
                                    <div class="box box-solid">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Folders</h3>
                          
                                        <div class="box-tools">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="box-body no-padding">
                                        <ul class="nav nav-pills nav-stacked">
                                          <li ><a href="/parent/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-inbox"></i> Inbox
                                          <li class="active"><a href="/parent/messages/{{Auth::user()->id}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                          <li><a href="/parent/messages/{{Auth::user()->id}}/compose"><i class="fa fa-file-text-o"></i> Compose</a></li>
                                        
                                          </li>
                                      
                                        </ul>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                              
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-md-9">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Sent</h3>
                          
                                        <div class="box-tools pull-right">
                                          <div class="has-feedback">
                                       
                                          </div>
                                        </div>
                                        <!-- /.box-tools -->
                                      </div>

            <div class="row" id="inbox">
                        
                        
                    <div class="col-xl-12" >
          
       
                    <div class="table-responsive">
            
                            
                          <table id="mytable" class="table table-bordred table-striped">
                               
                               <thead>
                                                          
                               </thead>
                <tbody>
       @foreach($message_sender as $message)
                    <tr >
                        
                        <td>{{$message->student->name}} 
                        {{$message->parent->name}} 
                        {{$message->teacher->name}}
                        {{$message->admin->name}}</td>
                        <td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="outbox/{{$message->id}}">{{$message->message_title}} </a></td> 
                        <td>{{$message->created_at}}</td>
     
                </tr>          
                        @endforeach
                
               
                
                </tbody>
                    
            </table>
</div>
                    </div>
            </div>
            

</div>


@endsection

            

    
                
  