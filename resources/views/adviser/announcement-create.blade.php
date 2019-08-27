        
        @extends('layouts.user')

<style>
     
        #submit{
                position: relative;
                float:right;
                top: 100%;
        }
        </style>

@section('content')
<div class="container" id ="view">

            <div class="col-lg-12 p-t-20">
                    <legend> Create announcement </legend>
                    <form action = "{{route('announcement.store',$classes->get(0)['id'])}}" method="post" enctype="multipart/form-data">
                                {{csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                  <input class="form-control"  name="title" id="title" placeholder="Subject:">
                                </div>
                                <div class="form-group">
                                      <textarea id="body" name="body"    class="form-control" style="height: 300px">
                                      
                                      </textarea>
                                      <br>
                                      <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                                        Create
                                   </button>
                                </div>
            </div>
        </div>
</div>

        @endsection
