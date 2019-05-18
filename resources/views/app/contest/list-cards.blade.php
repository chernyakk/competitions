@extends('layouts.app')

@section('content')
    <div class="list-group">
        @foreach($sportsmen as $key => $item)
        <a href="/cards/contest/{{ $item->contest_id }}/sportsman/{{ $item->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-danger">{{ $item->sportsman }}</h5>
                <small class="text-primary">{{ \App\Models\Contest::where('id', $item->contest_id)->first()->name }}</small>
            </div>
            <p class="mb-1"></p>
            <small class="text-success">карточка спортсмена</small>
        </a>
        @endforeach
    </div>
@endsection
