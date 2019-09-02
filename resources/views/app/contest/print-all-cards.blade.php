@extends('layouts.app')

@section('content')

    <div>
        <div>
            <button class="btn btn-success noprint" onclick="print()">Печать</button>
            <a href="#" onclick="history.go(-1); return false;" class="float-right">
                <button class="btn btn-primary noprint">К списку участников</button>
            </a>
        </div>
        <br>
        <div>
            @foreach($sportsmenInComp as $only)
                <div style="display: none">
                    {{$data = \Illuminate\Support\Facades\DB::table('sportsmen')
                        ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                        ->where('results.contest_id', '=', $contestId)
                        ->where('results.sector', '=', $only->sector)
                        ->where('results.tour_id', '<=', ($tourCount / 2))
                        ->select('sportsmen.sportsman', 'results.id', 'results.sportsman_id', 'results.contest_id', 'results.tour_id',
                            'results.point', 'results.haul', 'results.place', 'results.sector', 'results.sector_type')
                        ->get()}}
                </div>
                <div>
                    <div>
                        <br>
                        <h2 class="float-left">№ {{ $only->sector }} {{ $only->sportsman }}</h2>
                        <h2 class="float-right">{{ $contestName }}</h2>
                        <br>
                    </div>
                    <br><br>
                    <table class="table table-bordered table-striped myclass">
                        <thead>
                        <tr>
                            <th rowspan="2" scope="col"></th>
                            <th rowspan="2" scope="col">Сектор</th>
                            <th rowspan="2" scope="col">Соперник</th>
                            <th colspan="2" scope="col">Поимки</th>
                            <th rowspan="2" scope="col">Результат (баллов):</th>
                            <th rowspan="2" scope="col">Подпись</th>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div style="display: none">
                    {{$data = \Illuminate\Support\Facades\DB::table('sportsmen')
                        ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                        ->where('results.contest_id', '=', $contestId)
                        ->where('results.sector', '=', $only->sector)
                        ->where('results.tour_id', '>', ($tourCount / 2))
                        ->select('sportsmen.sportsman', 'results.id', 'results.sportsman_id', 'results.contest_id', 'results.tour_id',
                            'results.point', 'results.haul', 'results.place', 'results.sector', 'results.sector_type')
                        ->get()}}
                </div>
                <div style="page-break-after: always">
                    <div>
                        <br>
                        <h2 class="float-left">№ {{ $only->sector }} {{ $only->sportsman }}</h2>
                        <h2 class="float-right">{{ $contestName }}</h2><br>
                    </div>
                    <br><br>
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
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            @endforeach
        </div>
    </div>
@endsection
