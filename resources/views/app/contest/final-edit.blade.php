@extends('layouts.app')

@section('content')
<h2>{{ $contest }}</h2>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="table table-bordered table-striped myclass">
            <thead>
                <tr>
                    <th rowspan="2" scope="col">Спортсмен</th>
                    <th rowspan="2" scope="col">Поимки</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sportsman1 }}</td>
                    <td>
                        <input  name="hauls1" type="text" class="card-edit" id="card" value="{{ $hauls1 }}" size="2" />
                    </td>
                </tr>
                <tr>
                    <td>{{ $sportsman2 }}</td>
                    <td>
                        <input  name="hauls2" type="text" class="card-edit" id="card" value="{{ $hauls2 }}" size="2" />
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-success">Сохранить поимки</button>
            <a href="#" onclick="history.go(-1); return false;">
                <button type="button" class="btn btn-outline-danger">Отмена</button>
            </a>
        </div>
    </form>
@endsection
