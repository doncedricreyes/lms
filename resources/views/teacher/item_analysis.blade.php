
@extends('layouts.user')

<style>
    #submit{
     
        float: right;
    }

#searchbar{
 
  display: block;
text-align: center;
}
#search{
 position: relative;
 left: 37%;
}

     .mdl-data-table th, td{
text-align: left !important;
font-size: 16px;
}
#head {
background-color:#488cc7;
text-align: center !important;
font-size: 28px;
color: white;
}
#table{
background-color:snow;
}
</style>
@section('content')

<div class="container" id="view">
    <div class="row">
        <div class="col-lg-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading" id="head">Questions</div>




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
            <div class="panel-heading" id="head">Item Analysis
                <br>
                    <form action="{{route('item.analysis',$exams->get(0)->id)}}" method="GET">
                            
                              <div id="searchbar">
                                  
                                  <select  name="attempt" id="attempt" onchange="this.form.submit()">
                                       <option disabled selected value> -- select attempt -- </option>
                                      @for($i=1; $i <= $exams->get(0)->attempts;$i++)
                                    <option value={{$i}}>Attempt {{$i}}</option>
                                    @endfor
                                  </select>
                                </div>  
                            </form>
        

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
