@extends('layout')
@section('content')

<form action="/article" method="POST">
    @csrf
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ date('Y.d.m') }}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <input type="desc" class="form-control" id="desc" name="desc">
    </div>
    <button type="submit" class="btn btn-primary">Save article</button>
</form>
</form>

@if ($errors->any())
    <div id="toast-container">
        @foreach ($errors->all() as $error)
            <div class="toast-message alert alert-danger mt-3">
                {{$error}}
            </div>
        @endforeach
    </div>
@endif
    
@endsection