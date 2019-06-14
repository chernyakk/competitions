@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fio">ФИО спортсмена</label>
                <input type="text" class="form-control" id="fio" name="fio" aria-describedby="help" placeholder="{{ $s }}" value="{{ $s }}">
                <small id="help" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="number">Номер спортсмена</label>
                <input type="text" class="form-control" id="fio" name="number" aria-describedby="help" placeholder="{{ $n }}" value="{{ $n }}">
                <small id="help" class="form-text text-muted"></small>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="#" onclick="history.go(-1); return false;">
                    <button type="button" class="btn btn-danger">Отмена</button>
                </a>
            </div>
        </form>
    </div>
@endsection
