@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создание соревнования</div>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="count-tour">Наименование соревнования</label>
                                    <input type="text" class="form-control" id="cup" name="cup" placeholder="введите наименование соревнования" required>
                                </div>
                                <div class="form-group">
                                    <label for="count-tour">Количество туров</label>
                                    <input type="number" min="8" max="12" class="form-control" id="count-tour" name="tours" placeholder="введите количество туров" required>
                                </div>
                                <div class="form-group">
                                    <label for="file">Загрузка участников соревнования (в формате xlsx)</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radioOption" id="inlineRadio" value="1">
                                        <label class="form-check-label" for="inlineRadio">Включен</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radioOption" id="inlineRadio" value="0">
                                        <label class="form-check-label" for="inlineRadio">Выключен</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Создать соревнование</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
