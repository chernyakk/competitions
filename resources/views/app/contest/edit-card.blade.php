@extends('layouts.app')

@section('content')
    <table class="table table-bordered table-striped myclass">
        <thead>
        <tr>
            <th rowspan="2" scope="col"> <h4>{{ $sportsman }}</h4> </th>
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
                <td>
                    <input type="text" class="card-edit" id="card" value="{{ $item->haul }}" size="2" />
{{--                    <a href="/contest/{{ $item->contest_id }}/sportsman/{{ $item->sportsman_id }}/haul/edit/{{ $item->id }}" title="Изменить" aria-label="Редактировать">--}}
{{--                        <span class="fas fa-edit"></span>--}}
{{--                    </a> --}}
                </td>
                <td>
                    <input type="text" class="card-edit" id="card" value="{{ $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('results.haul')
                 ->value('haul')
                 }}" size="2" />
{{--                    {{--}}
{{--                    $s = \Illuminate\Support\Facades\DB::table('sportsmen')--}}
{{--                     ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')--}}
{{--                     ->where('results.contest_id', '=', $item->contest_id)--}}
{{--                     ->where('results.tour_id', '=', $item->tour_id)--}}
{{--                     ->where('results.place', '=', $item->place)--}}
{{--                     ->where('results.sportsman_id', '<>', $item->sportsman_id)--}}
{{--                     ->select('results.id')--}}
{{--                     ->value('id')--}}
{{--                 }}--}}
                </td>
                <td>{{ $item->point }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
