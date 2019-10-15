


@extends('layouts.user')
<style>
        #searchbar{
          position: relative;
          left: 1%;
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
                        
                         <div class="col-lg-12 col-md-offset-0">
                            <div class="panel panel-default">
                                <div class="panel-heading">Subjects</div>
                                <br>
                                <div id="searchbar">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create Subject</button>
                                </div>
                                <div class="panel-body"> 
                                    <div class="table-responsive">
                            
                                            
                                      <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                   
                                        <th>Subject</th>
                                       
                                      <th>Edit</th>
                                       <th>Delete</th>
                                 
                                   </thead>
                    <tbody>
                    
                            @foreach($subjects as $row)
                            <tr>
                                <td>{{$row->title}}</td>
                           
                              
                   
                                <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                
                                <form action="{{route('subject.destroy',[$row->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-sm" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                </tr>
                    @endforeach
          
                   
                    
                    </tbody>
                        
                </table>
                          <div class="text-center">
                    {{ $subjects->links() }}
                   
                    </div>
    </div>
    </div>
@endsection

            



<!-- Modal -->
<form action = "{{route('subject.store')}}" method="post"  enctype="multipart/form-data">
{{csrf_field() }}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
<label for="title">Subject Title:</label>
<input class="mdl-textfield__input" type="text" name="title" id="title" placeholder="Enter subject" >

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<input type="submit" class="btn btn-primary" value="Create Subject">
</div>
</div>
</div>
</div>
</form>

@foreach($subjects as $row)
<form action = "{{route('subject.update', $row->id)}}" method="post" enctype="multipart/form-data">
    
    {{csrf_field() }}
    <input name="_method" type="hidden" value="PUT">
    
    <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="editLabel">Edit Subject</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    <label for="title">Subject Title:</label>
    <input class="mdl-textfield__input" type="text" name="title" id="title" value="{{$row->title}}">
    
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" value="Create Subject">
    </div>
    </div>
    </div>
    </div>

</form>
@endforeach
