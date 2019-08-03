


@extends('layouts.user')

@section('content')
    <div class="container" id="view">
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>Students</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>View</th>
                                       <th>Delete</th>
                                       
                                   </thead>
                    <tbody>
                    
                            @foreach($students as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="/admin/students/{{$row->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                   
                             
                                
                                <form action="{{route('student.destroy',[$row->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                </tr>
                    @endforeach
                    <div class="text-center">
                    {{ $students->links() }}
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>


@endsection




            

    
                
  