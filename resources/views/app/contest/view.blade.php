@extends('layouts.app')

@section('content')
    <h1>Результаты</h1>
    <h2>Итоговая таблица</h2>

    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col"></th>
            @for($i = 0; $i < $ct; $i++)
                <th scope="col" colspan="2">{{ $i + 1 }} тур</th>
            @endfor
        </tr>
        <tr>
        <th scope="col">Спортсмен</th>
        @for($i = 0; $i < $ct; $i++)
            <th scope="col"><span class="badge badge-success">П</span></th>
            <th scope="col"><span class="badge badge-danger">Б</span></th>
        @endfor
        <th scope="col">Итого</th>
        <th scope="col">Место</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
        </tr>
        </tbody>
    </table>
@endsection
