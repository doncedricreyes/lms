
        
        
        @extends('layouts.user')
<style>
        #content{
                position: relative;
                width: 100%;
        }
        #submit{
                position: relative;
                float:right;
                
        }
        </style>
@section('content')
<div class="container" id ="view">
	<legend>Edit Announcement</legend>
            <div class="col-lg-12 p-t-20">
                     <form action = "{{route('announcement.update',$class_announcements->first()->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="box-body">
                                        <div class="form-group">
                                          <input class="form-control"  name="title" id="title" value="{{$class_announcements->first()->title}}" >
                                        </div>

                                        <div class="form-group">
                                                        <textarea id="body" name="body" class="form-control" style="height: 300px">{{$class_announcements->first()->body}}             
                                                        </textarea>
                        <br>
                    <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                           Update
                       </button>
                                        </div>
                                    </div>
</div>

        @endsection
