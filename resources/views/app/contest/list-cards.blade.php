@extends('layouts.app')

@section('content')
    <div class="list-group">
        <div class="back">
            <a href="{{ route('listContest') }}"><button class="btn btn-outline-primary">Вернуться назад</button></a>
                <a href="/cards/contest/{{$contestId}}/allcards/" class="float-right"><button class="btn btn-danger">Список карточек</button></a>
                <a href="/cards/contest/{{$contestId}}/print-cards/" class="float-right"><button class="btn btn-success">Печать карточек</button></a>
        </div>
        <br>
        @foreach($sportsmen as $key => $item)
        <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-dark">№ {{ $item->sector }} {{ $item->sportsman }}</h5>
                <small class="text-primary">{{ \App\Models\Contest::where('id', $item->contest_id)->first()->name }}</small>
            </div>
            <a class="mb-1">
                <a href="/cards/contest/{{ $item->contest_id }}/sportsman/{{ $item->id }}"><button class="btn btn-outline-success">Перейти в карточку</button></a>
                <a href="/contest/{{ $item->contest_id }}/sportsman/edit/{{ $item->id }}"><button class="btn btn-outline-primary">Редактировать спортсмена</button></a>
            </p>
            <div class="text-dark"></div>
        </div>
        @endforeach
    </div>
@endsection
