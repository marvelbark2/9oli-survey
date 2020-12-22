@extends('layouts.app', ['page' => __('Sondages'), 'pageSlug' => 'test'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> {{$Survey->name}}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter"
            data-toggle="table"
            id="table"
            data-pagination="true"
            data-search="true">
            <thead class=" text-primary">
              <tr>
                <th data-sortable="true">
                  Name
                </th>
                <th data-sortable="true">
                  Profession
                </th>
                <th data-sortable="true">
                  Date de naissance
                </th>
                <th data-sortable="true">
                  Etude
                </th>
                 @foreach ($Survey->questions as $question)
                    <th>{{$question->content}}</th>
                 @endforeach
              </tr>
            </thead>
             <tbody>
                @foreach ($Survey->entries as $entrie)
                    <tr>
                        <td data-fixed-columns="true">{{$entrie->participant->name}}</td>
                        <td data-fixed-columns="true">{{$entrie->participant->profession}}</td>
                        <td data-fixed-columns="true">{{$entrie->participant->dob}}</td>
                        <td data-fixed-columns="true">{{$entrie->participant->studies}}</td>
                        @foreach ($entrie->answers as $item)
                            <td class="text-center">{{$item->value}}</td>
                        @endforeach
                    </tr>
                @endforeach

                </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> {{$Survey->name}}</h4>
      </div>
      <div class="card-body">
        <div id="chart_div"></div>
      </div>
    </div>
  </div>

</div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.16.0/bootstrap-table.min.css" integrity="sha256-cCxZ912RWIYqgo3Di4S0U4rdHxVGoqE23gqVU4XNABE=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.16.0/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" integrity="sha256-a6UyvPn0W8HKgfEL9qaclqPtOPnjyM3XBNFI6rIiyxk=" crossorigin="anonymous" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.16.0/bootstrap-table.min.js" integrity="sha256-JFzlEUS2cZGdNFhVNH3GSFuqZFLjzWIjOqG5BY+Yhvw=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.16.0/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('#table').bootstrapTable({
            search: true,
            showColumns: false,
            toolbar: false,
            clickToSelect: false,
            fixedColumns: true,
            fixedNumber: 4,
            toolbar: '.toolbar',
            fixedRightNumber: 0
        })

    </script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Questions', @foreach ($Survey->questions as $question)'{{$question->content}}',@endforeach { role: 'annotation' }
        ],
        ['{{$Survey->name}}', 10, 24, 20, '']
      ]);

        // Set chart options
        var options = {
        width: 1000,
        height: 500,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
@endpush
