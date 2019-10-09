

@extends('layouts.user')

<style>
        #inbox{
            position: absolute;
    
            left: 2%;
            width: 100%;
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
                                  <li><a href="/parent/messages/{{Auth::user()->id}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                
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
                                        <h3 class="box-title">Compose New Message</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <?php $i = Auth::user()->id ?>
                                      <form action = "{{route('parent.message.compose.store',$i)}}" method="post" enctype="multipart/form-data">
                                       {{csrf_field() }}
                                      <div class="box-body">
                                        <div class="form-group">
                                          <input class="form-control" id="name" name="name" placeholder="To:">
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control"  name="role" id="role" placeholder="Role:">
                                              </div>
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

            

    
                
  
