@extends('layouts.app')

@section('content')
    <div class="list-group">
        <div class="back">
            <a href="{{ route('listContest') }}"><button class="btn btn-outline-primary">К списку соревнований</button></a>
            <a href="/contest/{{$contestId}}" class="float-right">
                <button class="btn btn-danger">Результаты соревнования</button>
            </a>
            <a href="/cards/contest/{{$contestId}}/allcards/" class="float-right">
                <button class="btn btn-success">Печать карточек</button>
            </a>
        </div>
        <br>

        @foreach($sportsmenInComp as $only)
            <div>
                <h2>№ {{ $only->sector }} {{ $only->sportsman }}</h2>

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
                    <div style="display: none">
                        {{$data = \Illuminate\Support\Facades\DB::table('sportsmen')
                            ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                            ->where('results.contest_id', '=', $contestId)
                            ->where('results.sector', '=', $only->sector)
                            ->select('sportsmen.sportsman', 'results.id', 'results.sportsman_id', 'results.contest_id', 'results.tour_id',
                                'results.point', 'results.haul', 'results.place', 'results.sector', 'results.sector_type')
                            ->get()}}
                    </div>
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
                            <td> {{ $item->haul }}</td>
                            <td> {{ $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('results.haul')
                 ->value('haul')
                 }}</td>
                            <td>{{ $item->point }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <a href="/cards/edit/contest/{{ $item->contest_id }}/sportsman/{{ $item->sportsman_id }}"><button class="btn btn-outline-success">Редактировать карточку</button></a>
                <a href="/contest/{{ $item->contest_id }}/sportsman/edit/{{ $item->sportsman_id }}"><button class="btn btn-outline-primary">Редактировать спортсмена</button></a>
            </div>
            <br>
        @endforeach
        <div class="back">
            <a href="{{ route('listContest') }}"><button class="btn btn-outline-primary">К списку соревнований</button></a>
        </div>
@endsection
