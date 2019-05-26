@extends('layouts.app')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
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
                    <input  name="{{ $item->tour_id }}" type="text" class="card-edit" id="card" value="{{ $item->haul }}" size="2" />
                </td>
                <td>
                    <input name="{{
                    $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                     ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                     ->where('results.contest_id', '=', $item->contest_id)
                     ->where('results.tour_id', '=', $item->tour_id)
                     ->where('results.place', '=', $item->place)
                     ->where('results.sportsman_id', '<>', $item->sportsman_id)
                     ->select('results.id')
                     ->value('id')
                 }}" type="text" class="card-edit" id="card" value="{{ $s = \Illuminate\Support\Facades\DB::table('sportsmen')
                 ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
                 ->where('results.contest_id', '=', $item->contest_id)
                 ->where('results.tour_id', '=', $item->tour_id)
                 ->where('results.place', '=', $item->place)
                 ->where('results.sportsman_id', '<>', $item->sportsman_id)
                 ->select('results.haul')
                 ->value('haul')
                 }}" size="2" />
                </td>
                <td>{{ $item->point }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-success">Сохранить</button>
        </div>
    </form>
@endsection
