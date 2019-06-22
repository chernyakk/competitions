@extends('layouts.app')

@section('content')
    <h2>Список соревнований</h2>
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">Наименование соревнования</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        @if ($contests)
            <tbody>
            @foreach($contests as $contest)
                @if ($contest)
                    @if($contest->status)
                    <tr>
                        <td class="text-center">{{ $contest->name }}</td>
                        <td class="text-center">
                            <a href="/guest/cards/{{ $contest->id }}" title="Карточки" aria-label="Карточки">
                                <button class="btn btn-outline-danger btn-sm"
                                        @if ($contest-> rand != 1) data-toggle="tooltip" data-placement="bottom"
                                        title="Станут доступны после жеребьёвки" disabled
                                    @endif>Карточки</button>
                            </a>
                            <a href="/guest/contest/{{ $contest->id }}" title="Результаты" aria-label="Результаты">
                                <button class="btn btn-outline-primary btn-sm"
                                        @if ($contest-> rand != 1) data-toggle="tooltip" data-placement="bottom"
                                        title="Станут доступны после жеребьёвки" disabled
                                    @endif>Результаты</button>
                            </a>
                        </td>
                    </tr>
                    @endif
                @endif
            @endforeach
            </tbody>
    </table>
    @else
        <tr>
            <td colspan="5" class="text-center align-middle">
                <h4>Нет доступных для просмотра соревнований</h4>
            </td>
        </tr>
    @endif

    <div class="back"><a href="{{ '/' }}"><button class="btn btn-outline-primary">К основному экрану</button></a></div>

@endsection
