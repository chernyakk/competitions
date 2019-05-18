@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label for="haul">Поимка</label>
            <input type="text" class="form-control" id="haul" name="haul" aria-describedby="help" placeholder="Введите поимку в поле ввода">
            <small id="help" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

@endsection
