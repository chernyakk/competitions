@extends('layouts.app')

@section('content')
    <h2>№ {{ $numberCard }} {{ $sportsman }}</h2>
    <br>
    <table class="table table-bordered table-striped myclass">
        <thead>
        <tr>
            <th rowspan="2" scope="col"></th>
            <th rowspan="2" scope="col">Сектор</th>
            <th rowspan="2" scope="col">Соперник</th>
            <th colspan="2" scope="col">Поимки</th>
            <th rowspan="2" scope="col">Результат (баллов):</th>
        </tr>
        <tr>
            <th>Личные</th>
            <th>Соперника</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">Тур {{ $item->tour_id }}</th>
            <td>{{ $item->place }}</td>
            <td>
                № {{ $n = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('results.sector')
                 ->value('sector')
                 }}

                {{ $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('sportsmen.sportsman')
                 ->value('sportsman')
                 }}
            </td>
            <td> {{ $item->haul }} <a href="/contest/{{ $item->contest_id }}/sportsman/{{ $item->sportsman_id }}/haul/edit/{{ $item->id }}" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td> {{ $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('results.haul')
                 ->value('haul')
                 }}
                <a href="/contest/{{ $item->contest_id }}/sportsman/{{ $item->sportsman_id }}/haul/edit/{{
                    $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                     ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                     ->where('results.contest_id', '=', $item->contest_id)
                     ->where('results.tour_id', '=', $item->tour_id)
                     ->where('results.place', '=', $item->place)
                     ->where('results.sportsman_id', '<>', $item->sportsman_id)
                     ->select('results.id')
                     ->value('id')
                 }}" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td>{{ $item->point }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="form-group">
        <a href="/cards/edit/contest/{{ $item->contest_id }}/sportsman/{{ $item->sportsman_id }}"><button class="btn btn-outline-success">редактировать карточку</button></a>
        <a href="/cards/contest/{{ $item->contest_id }}"><button class="btn btn-outline-primary">вернутся назад</button></a>
    </div>
@endsection
