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
        @if ($contests)
            <tbody>
            @foreach($contests as $contest)
                @if ($contest)
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
                            <button class="btn btn-outline-danger btn-sm"
                                    @if ($contest-> rand != 1) data-toggle="tooltip" data-placement="bottom"
                                    title="Станут доступны после жеребьёвки" disabled
                                @endif>Карточки</button>
                        </a>
                        <a href="/contest/{{ $contest->id }}" title="Результаты" aria-label="Результаты">
                            <button class="btn btn-outline-primary btn-sm"
                                    @if ($contest-> rand != 1) data-toggle="tooltip" data-placement="bottom"
                                    title="Станут доступны после жеребьёвки" disabled
                                @endif>Результаты</button>
                        </a>
                        <a href="/contest/{{ $contest->id }}/final/results" title="Финал" aria-label="Итоги финала">
                            <button class="btn btn-outline-success btn-sm"
                                    @if ($arr[$contest->id]) data-toggle="tooltip" data-placement="bottom"
                                    title="Станет доступен после предварительного этапа" disabled
                                @endif>Итоги финала</button>
                        </a>
                        <a href="/contest/edit/{{ $contest->id }}" title="Редактировать" aria-label="Редактировать">
                            <button class="btn btn-outline-dark btn-sm">Редактировать</button>
                        </a>
                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#myModal{{ $contest->id }}">Удалить</button>
                    </td>
                </tr>
                @else <tr>
                    <td colspan="5" class="text-center align-middle">
                        <h5>Соревнование недоступно</h5>
                    </td>
                </tr>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="myModal{{ $contest->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <a href="/contest/delete/{{$contest->id}}" title="Удалить" aria-label="Удалить">
                                    <button type="button" class="btn btn-outline-danger">Да</button>
                                </a>
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Нет</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
    </table>
    @else
        <tr>
            <td colspan="5" class="text-center align-middle">
                <h4>Нет доступных соревнований</h4>
            </td>
        </tr>
    @endif

    <div class="back"><a href="{{ route('home') }}"><button class="btn btn-outline-primary">К панели управления</button></a></div>

@endsection
