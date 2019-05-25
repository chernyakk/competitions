@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cont">Наименование соревнования</label>
                <input type="text" class="form-control" name="cont" id="cont" aria-describedby="help" placeholder="Наименование соревнования" value="{{ $cont->name }}">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" @if($cont->status) checked @else @endif name="status" id="status">
                    <label class="form-check-label" for="status">
                        включено / выключено
                    </label>
                </div>
                <small id="help" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
