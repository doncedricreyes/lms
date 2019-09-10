
@extends('layouts.user')

<style>
        .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }
    @media screen and (max-width: 767px) {
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
        }
        .table-responsive > .table {
            margin-bottom: 0;
        }
        .table-responsive > .table > thead > tr > th,
        .table-responsive > .table > tbody > tr > th,
        .table-responsive > .table > tfoot > tr > th,
        .table-responsive > .table > thead > tr > td,
        .table-responsive > .table > tbody > tr > td,
        .table-responsive > .table > tfoot > tr > td {
            white-space: nowrap;
        }
        .table-responsive > .table-bordered {
            border: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:first-child,
        .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .table-responsive > .table-bordered > thead > tr > td:first-child,
        .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .table-responsive > .table-bordered > tfoot > tr > td:first-child {
            border-left: 0;
        }
        .table-responsive > .table-bordered > thead > tr > th:last-child,
        .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .table-responsive > .table-bordered > thead > tr > td:last-child,
        .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .table-responsive > .table-bordered > tfoot > tr > td:last-child {
            border-right: 0;
        }
        .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .table-responsive > .table-bordered > tfoot > tr:last-child > th,
        .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .table-responsive > .table-bordered > tfoot > tr:last-child > td {
            border-bottom: 0;
        }
    }
    </style>
@section('content')

<div class="container" id="view">
    <div class="row">
        <div class="col-lg-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">Questions</div>




            <div class="panel-body">    
                <div class="table-responsive">
                    <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                    <thead>
                        <tr>

                            <th>Question #</th>
                            <th>Question </th>
                            <th>Score </th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Option 5</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                       
         
                      @foreach($questions as $question)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{$question->question}}</td>
                <td>{{$question->score}}</td>
                <td>{{$question->option_1}}</td>
                <td>{{$question->option_2}}</td>
                <td>{{$question->option_3}}</td>
                <td>{{$question->option_4}}</td>
                <td>{{$question->option_5}}</td>
                <td>{{$question->answer}}</td>
@endforeach

                            </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">Item Analysis

                    <form action="{{route('item.analysis',$exams->get(0)->id)}}" method="GET">
                            
                              <div class="form-group">
                                  
                                  <select  name="attempt" id="attempt" onchange="this.form.submit()">
                                      @for($i=1; $i < $exams->get(0)->attempts;$i++)
                                    <option selected value={{$i}}>Attempt {{$i}}</option>
                                    @endfor
                                  </select>
                                </div>  
                            </form>
            </div>

            <div class="panel-body">    
                    <div class="table-responsive">
                    <table class="mdl-data-table mdl-js-data-table col-lg-12" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Option 5</th>
                        </tr>
                        <tr>
                            <th>Question #</th>
                            <th>Average </th>
                            <th>Average </th>
                            <th>Average </th>
                            <th>Average </th>
                            <th>Average </th>  
                            <th>Total Count </th> 
                            <th>Correct Count</th>  
                            <th>% Correct </th>            
                        </tr>
                    </thead>
                    <tbody>
                       
         
                      @foreach($questions as $question)
            <tr>
                    <td>{{ $loop->iteration }} </td>
                
                   
                    <td>{{$avg1[$counter]}}%</td>
                    <td>{{$avg2[$counter]}}%</td>
                    <td>{{$avg3[$counter]}}%</td>
                    <td>{{$avg4[$counter]}}%</td>
                    <td>{{$avg5[$counter]}}%</td>
                    <td>{{$students}}</td>
                    <td>{{$answ[$counter]}}</td>
                    <td>{{$avg6[$counter]}}%</td>
                    <div class="hidden">
                    {{$counter = $counter+1}}
                    </div>
@endforeach

                            </tr>
                    </tbody>
                </table>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
