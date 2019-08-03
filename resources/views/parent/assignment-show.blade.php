@extends('layouts.user')

@section('content')



<div class="container" id="view">

    @foreach($assignments as $assignment)
    <h1><legend>{{$assignment->title}}</legend></h1>
    @endforeach
    @foreach($assignments as $assignment)
    <div id="description" class="col-lg-8">
    <h3>{{$assignment->description}}</h3>
    <br>
<h4>Submission starts: {{$assignment->date_start}} </h4>
<h4>Submission deadline: {{$assignment->date_end}} </h4>
  <br><br>
  @endforeach


</div>

@endsection