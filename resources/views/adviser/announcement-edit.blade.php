@extends('layouts.user')
<style>
        #content{
                position: relative;
                width: 100%;
        }
        #submit{
                position: absolute;
                right: 10%;
                top: 100%;
        }

        </style>
@section('content')
<div class="container" id ="view">
	<div >
            <div class="col-lg-12 p-t-20">
                    <form action = "{{route('announcement.update',$class_announcements->first()->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input class="mdl-textfield__input" type="text" name="title" value="{{$class_announcements->first()->title}}" >
                        <label class="mdl-textfield__label">Subject</label>
                    </div>
                </div>

                <div class="col-lg-12 p-t-20">
                        <div id="content" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label" >Content</label>
                            <textarea class="mdl-textfield__input" type="text" rows= "7"  id="body" name="body">{{$class_announcements->first()->body}}</textarea>
    
                                        </div>
                                    </div>

                    <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                            Submit
                       </button>
                      
</div>

        @endsection