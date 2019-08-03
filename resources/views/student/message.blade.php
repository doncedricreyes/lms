
  

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
                                  <li ><a href="/student/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-inbox"></i> Inbox
                                  <li><a href="/student/messages/{{Auth::user()->id}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                  <li  class="active"><a href="/student/messages/{{Auth::user()->id}}/compose"><i class="fa fa-file-text-o"></i> Compose</a></li>
                                
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
                                      @if (\Route::current()->getName() == 'teacher.student.message.index')
<form action = "{{route('teacher.student.message.store', $students->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$students->get(0)->name}}" placeholder="To:" readonly>
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
@endif
@if (\Route::current()->getName() == 'teacher.parent.message.index')
<form action = "{{route('teacher.parent.message.store', $parents->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$parents->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'message.index')
<form action = "{{route('message.store', $students->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$students->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'message.teacher.index')
<form action = "{{route('message.teacher.store', $teachers->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$teachers->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'teacher.message.index')
<form action = "{{route('teacher.message.store', $teachers->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$teachers->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'parent.message.teacher.index')
<form action = "{{route('parent.message.teacher.store', $teachers->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$teachers->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'admin.student.message.index')
<form action = "{{route('admin.student.message.store', $students->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$students->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'admin.teacher.message.index')
<form action = "{{route('admin.teacher.message.store', $teachers->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$teachers->get(0)->name}}" placeholder="To:" readonly>
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
@endif

@if (\Route::current()->getName() == 'admin.parent.message.index')
<form action = "{{route('admin.parent.message.store', $parents->get(0)->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        
        <div class="box-body">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" value="{{$parents->get(0)->name}}" placeholder="To:" readonly>
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
@endif
            </div>
            

</div>


@endsection



            

    
                
  