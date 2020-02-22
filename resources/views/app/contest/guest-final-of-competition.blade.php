@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="back">
            @if(($finalists[12]->hauls)&&($finalists[13]->hauls)&&($finalists[14]->hauls)&&($finalists[15]->hauls))
            <a href="/guest/contest/{{ $id }}/final/results" class="float-right">
                <button class="btn btn-outline-success">Итоговые результаты</button>
            </a> @endif
            <a href="/guest/contest/{{$id}}" class="float-right">
                <button class="btn btn-outline-danger">Результаты соревнования</button>
            </a>
            <a href="{{ route('guestListContest') }}">
                <button class="btn btn-outline-primary">К списку соревнований</button>
            </a>
        </div>
        <br>
        @if ($check1)
        <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th colspan="5">1/4 финала</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[0]->sportsman}} </td>
                <td> {{$finalists[0]->hauls}} : {{$finalists[1]->hauls}} </td>
                <td colspan="2"> {{$finalists[1]->sportsman}} </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[2]->sportsman}} </td>
                <td> {{$finalists[2]->hauls}} : {{$finalists[3]->hauls}} </td>
                <td colspan="2"> {{$finalists[3]->sportsman}} </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[4]->sportsman}} </td>
                <td> {{$finalists[4]->hauls}} : {{$finalists[5]->hauls}} </td>
                <td colspan="2"> {{$finalists[5]->sportsman}} </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[6]->sportsman}} </td>
                <td> {{$finalists[6]->hauls}} : {{$finalists[7]->hauls}} </td>
                <td colspan="2"> {{$finalists[7]->sportsman}} </td>
            </tr>
            </tbody>
        </table>
        @if ($check2 -> sportsman_id)
        <div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="5">1/2 финала</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[8]->sportsman}} </td>
                <td> {{$finalists[8]->hauls}} : {{$finalists[9]->hauls}} </td>
                <td colspan="2"> {{$finalists[9]->sportsman}} </td>
            </tr>
            <tr>
                <td colspan="2"> {{$finalists[10]->sportsman}} </td>
                <td> {{$finalists[10]->hauls}} : {{$finalists[11]->hauls}} </td>
                <td colspan="2"> {{$finalists[11]->sportsman}} </td>
            </tr>
            </tbody>
        </table>
                @if ($check3 -> sportsman_id)
    <div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="5">Финал</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"> {{$finalists[12]->sportsman}} </td>
                    <td> {{$finalists[12]->hauls}} : {{$finalists[13]->hauls}} </td>
                    <td colspan="2"> {{$finalists[13]->sportsman}} </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="5">За 3 место</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2"> {{$finalists[14]->sportsman}} </td>
                <td> {{$finalists[14]->hauls}} : {{$finalists[15]->hauls}} </td>
                <td colspan="2"> {{$finalists[15]->sportsman}} </td>
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
