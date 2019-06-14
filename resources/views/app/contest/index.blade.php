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
        @if ($contests !== null)
            <tbody>
            @foreach($contests as $contest)
                <tr>
                    <th scope="row">{{ $contest->id }}</th>
                    <td>{{ $contest->name }}</td>
                    <td>@if($contest->status) включено @else отключено @endif</td>
                    <td>{{ \Carbon\Carbon::parse($contest->created_at)->format('d/m/Y') }}</td>
                    <td>
                        <a href="/changer/{{$contest->id}}" title="Жеребьёвка" aria-label="Жеребьёвка">
                            <button class="btn btn-outline-success btn-sm" @if ($contest-> rand) style="display: none" @endif>Жеребьевка</button>
                        </a>
                        <a href="/cards/contest/{{ $contest->id }}" title="Карточки" aria-label="Карточки">
                            <button class="btn btn-outline-danger btn-sm">Карточки</button>
                        </a>
                        <a href="/contest/{{ $contest->id }}" title="Просмотр" aria-label="Просмотр">
                            <button class="btn btn-outline-primary btn-sm">Результаты</button>
                        </a>
                        <a href="/contest/edit/{{ $contest->id }}" title="Редактировать" aria-label="Редактировать">
                            <button class="btn btn-outline-dark btn-sm">Редактировать</button>
                        </a>
                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#myModal">Удалить</button>

                    </td>
                </tr>
            @endforeach
            </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Удаление соревнования</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <h4>Вы уверены, что хотите удалить соревнование {{$contest->name}}?</h4>
                </div>
                <div class="modal-footer">
                    <a href="/contest/delete" title="Удалить" aria-label="Удалить">
                        <button type="button" class="btn btn-outline-danger">Да</button>
                    </a>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="back"><a href="{{ route('home') }}"><button class="btn btn-outline-primary">К панели управления</button></a></div>

@endsection
