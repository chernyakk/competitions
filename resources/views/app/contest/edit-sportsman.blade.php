@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fio">ФИО спортсмена</label>
                <input type="text" class="form-control" id="fio" name="fio" aria-describedby="help" placeholder="Фамилия Имя Отчество спортсмена" value="{{ $s }}">
                <small id="help" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="number">Номер спортсмена</label>
                <input type="text" class="form-control" id="fio" name="number" aria-describedby="help" placeholder="Номер" value="{{ $n }}">
                <small id="help" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
