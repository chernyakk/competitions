@extends('layouts.app')

@section('content')
    <div class="list-group">
        @foreach($sportsmen as $key => $item)
        <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-danger">{{ $item->sportsman }}</h5>
                <small class="text-primary">{{ \App\Models\Contest::where('id', $item->contest_id)->first()->name }}</small>
            </div>
            <a class="mb-1">
                <a href="/cards/contest/{{ $item->contest_id }}/sportsman/{{ $item->id }}"><button class="btn btn-outline-success">Перейти в карточку</button></a>
                <a href="/contest/{{ $item->contest_id }}/sportsman/edit/{{ $item->id }}"><button class="btn btn-outline-primary">Редактировать спортсмена</button></a>
            </p>
            <small class="text-success">карточка спортсмена</small>
        </div>
        @endforeach
    </div>
@endsection
