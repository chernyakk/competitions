@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="back">
            @if(($finalists[12]->hauls)&&($finalists[13]->hauls)&&($finalists[14]->hauls)&&($finalists[15]->hauls))
            <a href="/contest/{{ $id }}/final/results" class="float-right">
                <button class="btn btn-outline-success">Итоговые результаты</button>
            </a> @endif
            <a href="/contest/{{$id}}" class="float-right">
                <button class="btn btn-outline-danger">Результаты соревнования</button>
            </a>
            <a href="{{ route('listContest') }}">
                <button class="btn btn-outline-primary">К списку соревнований</button>
            </a>
        </div>
        <br>
        <div @if ($check1) style="display:none" @endif>
            <a href="/contest/{{ $id }}/final/couples" title="Пары" aria-label="Подсчёт">
                <button class="btn btn-outline-success btn-sm">Распределить по парам</button>
            </a>
        </div>
        @if ($check1)
        <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th colspan="6">1/4 финала</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[0]->sportsman}} </td>
                <td> {{$finalists[0]->hauls}} : {{$finalists[1]->hauls}} </td>
                <td colspan="2"> {{$finalists[1]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[0]->now_id }}/vs/{{ $finalists[1]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[2]->sportsman}} </td>
                <td> {{$finalists[2]->hauls}} : {{$finalists[3]->hauls}} </td>
                <td colspan="2"> {{$finalists[3]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[2]->now_id }}/vs/{{ $finalists[3]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[4]->sportsman}} </td>
                <td> {{$finalists[4]->hauls}} : {{$finalists[5]->hauls}} </td>
                <td colspan="2"> {{$finalists[5]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[4]->now_id }}/vs/{{ $finalists[5]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[6]->sportsman}} </td>
                <td> {{$finalists[6]->hauls}} : {{$finalists[7]->hauls}} </td>
                <td colspan="2"> {{$finalists[7]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[6]->now_id }}/vs/{{ $finalists[7]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div @if ($check2 -> sportsman_id) style="display:none" @endif>
            <a href="/contest/{{ $id }}/final/semifinal" title="Подсчёт 1" aria-label="Подсчёт">
                <button class="btn btn-outline-success btn-sm">Полуфинальные пары</button>
            </a>
        </div>
            @if ($check2 -> sportsman_id)
        <div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="6">1/2 финала</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[8]->sportsman}} </td>
                <td> {{$finalists[8]->hauls}} : {{$finalists[9]->hauls}} </td>
                <td colspan="2"> {{$finalists[9]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[8]->now_id }}/vs/{{ $finalists[9]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[10]->sportsman}} </td>
                <td> {{$finalists[10]->hauls}} : {{$finalists[11]->hauls}} </td>
                <td colspan="2"> {{$finalists[11]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[10]->now_id }}/vs/{{ $finalists[11]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div @if ($check3 -> sportsman_id) style="display:none" @endif>
            <a href="/contest/{{ $id }}/final/finalCouples" title="Подсчёт 2" aria-label="Подсчёт">
                <button class="btn btn-outline-success btn-sm">Финальная пара</button>
            </a>
        </div>
            @if ($check3 -> sportsman_id)
            <div>
            <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="6">Финал</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[12]->sportsman}} </td>
                <td> {{$finalists[12]->hauls}} : {{$finalists[13]->hauls}} </td>
                <td colspan="2"> {{$finalists[13]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[12]->now_id }}/vs/{{ $finalists[13]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="6">За 3 место</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[14]->sportsman}} </td>
                <td> {{$finalists[14]->hauls}} : {{$finalists[15]->hauls}} </td>
                <td colspan="2"> {{$finalists[15]->sportsman}} </td>
                <td>
                    <a href="/contest/{{ $id }}/final/edit/{{ $finalists[14]->now_id }}/vs/{{ $finalists[15]->now_id }}" title="Поимки" aria-label="Редактировать">
                        <button class="btn btn-outline-success btn-sm">Внести поимки</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
            </div>
            @endif
        </div>
            @endif
        </div>
        @endif
    </div>

@endsection
