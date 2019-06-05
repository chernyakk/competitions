@extends('layouts.app')

@section('content')
    <h1>Результаты</h1>
    <h2>Итоговая таблица</h2>
    <table class="table table-bordered" id="grid">
        <thead class="thead-light">
        <tr>
            <th colspan="3"></th>
            @for($i = 0; $i < $ct; $i++)
                <th scope="col" colspan="2">{{ $i + 1 }} тур</th>
            @endfor
            <th colspan="3">Итого</th>
        </tr>
        <tr>
        <th>#</th>
        <th colspan="2">Спортсмен</th>
        @for($i = 0; $i < $ct; $i++)
            <th><span class="badge badge-success">П</span></th>
            <th><span class="badge badge-danger">Б</span></th>
        @endfor
        <th><span class="badge badge-success">П</span></th>
        <th><span class="badge badge-danger" id="sortId" data-sort-default>Б</span></th>
        <th>Место</th>
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach($cnt as $c)
            @if($c->tour_id === 1)
                <td>{{ $c->sector }}</td>
                <td colspan="2">{{ \App\Models\Sportsman::where('id', '=', $c->sportsman_id)->value('sportsman') }}</td>
            @endif
                <td>{{ $c->haul }}</td>
                <td>{{ $c->point }}</td>
                @if($c->tour_id%$ct === 0)
                    <td>{{ $sum->where('sportsman_id', $c->sportsman_id)->first()->haul }}</td>
                    <td>{{ $sum->where('sportsman_id', $c->sportsman_id)->first()->point }}</td>
                    <td></td>
            </tr>
                @endif
            @endforeach

        </tbody>
    </table>
    <div class="back"><a href="{{ route('listContest') }}"><button class="btn btn-outline-primary">вернутся назад</button></a></div>
@endsection
