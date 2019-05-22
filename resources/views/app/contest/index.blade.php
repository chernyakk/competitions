@extends('layouts.app')

@section('content')
        <h2>Список соревнований</h2>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Номер</th>
                <th scope="col">Наименование соревнования</th>
                <th scope="col">Статус</th>
                <th scope="col">Создано</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contests as $contest)
            <tr>
                <th scope="row">{{ $contest->id }}</th>
                <td>{{ $contest->name }}</td>
                <td>@if($contest->status) включено @else отключено @endif</td>
                <td>{{ \Carbon\Carbon::parse($contest->created_at)->format('d/m/Y') }}</td>
                <td>
                    <a href="/changer/{{ $contest->id }}" title="Жеребьевка" aria-label="Жеребьевка">
                    <button class="btn btn-outline-success btn-sm">жеребьевка</button>
                    </a>
                    <a href="/cards/contest/{{ $contest->id }}" title="Карточки" aria-label="Карточки">
                        <button class="btn btn-outline-danger btn-sm">карточки</button>
                    </a>
                    <a href="/contest/{{ $contest->id }}" title="Просмотр" aria-label="Просмотр">
                        <button class="btn btn-outline-primary btn-sm">результаты</button>
                    </a>
                    <a href="/contest/edit/{{ $contest->id }}" title="Редактировать" aria-label="Редактировать">
                        <button class="btn btn-outline-dark btn-sm">редактировать</button>
                    </a>
                    <a href="/contest/delete" title="Удалить" aria-label="Удалить">
                        <button class="btn btn-outline-danger btn-sm">удалить</button>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
