

@extends('layouts.user')

<style>
    #inbox{
        position: absolute;
        top: 10%;
        left: 20%;
        width: 80%;
    }
    #nav{
        position: absolute;
        top: 10%;
        right: 25%;
        width: 80%;
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
                                          <li ><a href="/admin/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-inbox"></i> Inbox
                                          <li><a href="/admin/messages/{{Auth::user()->id}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                          <li  class="active"><a href="/admin/messages/{{Auth::user()->id}}/compose"><i class="fa fa-file-text-o"></i> Compose</a></li>
                                        
                                          </li>
                                       
                                        </ul>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                              
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-lg-9">

                                                <div class="col-lg-12">
                                                                <div class="box box-primary">
                                                                  <div class="box-header with-border">
                                                                    <h3 class="box-title">Reply</h3>
                                                                  </div>
                                                                  <!-- /.box-header -->
                                                                  @foreach($messages as $message)
                                                                  <form action = "{{route('admin.message.reply.store',$message->id)}}" method="post" enctype="multipart/form-data">
                                                                      {{csrf_field() }}
                                                                      @endforeach
                                                                  <div class="box-body">
                                                                    <div class="form-group">
                                                                                @foreach($messages as $message)
                                                                      <input readonly class="form-control" id="name" name="name" value="{{$message->students['name']}}{{$message->parents['name']}}{{$message->teachers['name']}}{{$message->admins['name']}} ">
                                                        
                                                                      
                                                                 
                                                                    
                                                                
                                                                    </div>
                                                                    @endforeach
                                                                    <div class="form-group">
                                                                      <input class="form-control"  name="message_title" id="message_title" placeholder="Subject:">
                                                                    </div>
                                                                    <div class="form-group">
                                                                          <textarea id="message_body" name="message_body"    class="form-control" style="height: 300px">
                                                                          
                                                                          </textarea>
                                                                          <br>
                                                                          <input type="submit" value="Send Message">
                                                                    </div>
                                                </div>
                                                                  </form>
          
            </div>
            

</div>


@endsection

            

    
                
  
