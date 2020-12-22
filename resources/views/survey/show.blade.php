@extends('layouts.app', ['page' => __('Sondages'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> {{$survey->name}}</h4>
      </div>
      <div class="card-body">
        @include('survey::standard', ['survey' => $survey])
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
    @include('sweetalert::alert')
@endpush
