@extends('layouts.app', ['page' => __('Sondages'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Listes des sondages</h4>
      </div>
      <div class="card-body">
        <div class="row">
            @forelse ($surveys as $survey)
                <div class="col-md-6">
                    @if ($survey->isAnswered())
                        <div class="card bg-default">
                            <img class="card-img-top" src="holder.js/100x180/" alt="">
                            <div class="card-body">
                                <h4 class="card-title text-white">{{$survey->name}}</h4>
                                <p class="card-text text-white">{{$survey->created_at->diffForHumans()}}</p>
                                <a href="{{route('survey.show', $survey->id)}}" class="btn btn-primary">Resultat</a>
                                @if (Auth::user()->type === "Super_admin")
                                    <a href="#" class="btn btn-default">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                @endif

                            </div>
                        </div>
                    @else
                       <div class="card">
                            <img class="card-img-top" src="holder.js/100x180/" alt="">
                            <div class="card-body">
                                <h4 class="card-title">{{$survey->name}}</h4>
                                <p class="card-text">{{$survey->created_at->diffForHumans()}}</p>
                                <a href="{{route('survey.show', $survey->id)}}" class="btn btn-primary">Soumettre</a>
                                <a href="#" class="btn btn-default">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    @endif

                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <h4 class="card-title"></h4>
                            <p class="card-text">Pas de sondage</p>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
