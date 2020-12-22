@extends('layouts.app', ['page' => __('Sondages'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Listes des sondages</h4>
      </div>
      <div class="card-body">
        <div id="tree"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
    <script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/js/gijgo.min.js"></script>
    <script>
        var data = {!! $survey->questions !!} ;
        var questions = [];
        data.forEach(element => {
            if(element.options){
                var options = element.options;
                var opt = [];
                options.forEach(option => {
                    var op = {text: option};
                    opt.push(op)
                });
                var source = {text: element.content, children: opt};
            }else{
                var source = {text: element.content};
            }
            questions.push(source) ;
            });
        $('#tree').tree({

            dataSource: [{text: '{{$survey->name}}', children: questions}],
            width: 500,
            uiLibrary: 'bootstrap',
            checkboxes: false,
            checkedIcon: 'fa fa-check-square-o',
            uncheckedIcon: 'fa fa-square-o',
            expandIcon: 'fa fa-plus',
            collapseIcon: 'fa fa-minus'
        });

        console.log(questions[2]);

    </script>
@endpush
@push('css')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/css/gijgo.min.css'>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

@endpush
