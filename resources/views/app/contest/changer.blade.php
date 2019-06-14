@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="toss">Шаг жеребьёвки</label>
                <input type="text" class="form-control" id="toss" name="toss" aria-describedby="help" placeholder="Введите шаг жеребьёвки:">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

@endsection
