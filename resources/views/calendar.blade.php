@extends('layouts.user')

@section('content')
        <div class="container">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
            <div class="panel panel-primary">
                <div class="panel-heading">Event</div>
                <div class="panel-body">
                  @if(Auth::user()->role == 'student')
                        <form action="{{route('student.add_event')}}" method="POST" enctype="multipart/form-data">
                          @endif
                          @if(Auth::user()->role == 'teacher')
                          <form action="{{route('teacher.add_event')}}" method="POST" enctype="multipart/form-data">
                            @endif
                            @if(Auth::user()->role == 'admin')
                            <form action="{{route('admin.add_event')}}" method="POST" enctype="multipart/form-data">
                              @endif
                            {{csrf_field() }}
                        <div class="form-group">
                                <label>Event:</label>
                                  <input type="text" name="event_name" id="event_name" class="form-control pull-right" >
                                </div>
                        <div class="form-group">
                                <label>Date Start:</label>
                
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="date" name="start_date" id="start_date" class="form-control pull-right" >
                                </div>
                </div>
                <div class="form-group">
                        <label>Date End:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" name="end_date" id="end_date" class="form-control pull-right" >
                        </div>
        </div>
           <div class="form-group">
               <input type="submit">
           </div>
                        </form>
            </div>
          </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Event</div>
                <div class="panel-body">
                    <script>
                        @yield('pageScript')
                        </script>
                        {!! $calendar_details->script() !!}
              {!! $calendar_details->calendar() !!}
            </div>
            </div>
        </div>
        </div>
        @endsection