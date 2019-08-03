@extends('layouts.user')

@section('content')

<div class="container" id="view">

    <div class="row">
    <div class="col-md-12">
        <legend>Schedule</legend>

<div class="table-responsive">

        
      <table id="mytable" class="table table-bordred table-striped">
           
           <thead>
           
           
                <th>Subject</th>
                <th>Teacher</th>
                <th>Year and Section</th>  
                <th>Schedule</th>
           </thead>
<tbody>

    @foreach($schedules as $row)
    <tr>
        <td>{{$row->class_subject_teachers->get(0)->subjects->get(0)->title}}</td>
        <td>{{$row->class_subject_teachers->get(0)->teachers->get(0)->name}}</td>
        <td>{{$row->class_subject_teachers->get(0)->classes->get(0)->year}}-{{$row->class_subject_teachers->get(0)->classes->get(0)->section}}</td>
        <td>{{$row->class_subject_teachers->get(0)->schedule}}</td>
</tr>
@endforeach



</tbody>

</table>
</div>
</div>
</div>
</div>

@endsection