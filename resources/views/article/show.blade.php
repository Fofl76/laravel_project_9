@extends('layout')
@section('content')
<div class="card text-center mb-3" style="width: 58rem;">
<div class="card-header">
    Featured
</div>
  <div class="card-body">
    <h5 class="card-title">{{$article -> name}}</h5>
    <p class="card-text">{{ $article -> desc}}</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

@endsection