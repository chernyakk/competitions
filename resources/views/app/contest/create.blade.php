@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Создание соревнования</h3></div>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="cup">Наименование соревнования</label>
                                    <input type="text" class="form-control" id="cup" name="cup" placeholder="введите наименование соревнования" required>
                                </div>
                                <div>
                                    <label for="count-tour">Количество туров</label>
                                </div>
                                <div class="btn-group btn-block" data-toggle="buttons">
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="6"> 6
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="7"> 7
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="8"> 8
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="9"> 9
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="10"> 10
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="11"> 11
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" style="display: none" name="tours" id="count-tour" value="12"> 12
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="file">Загрузка участников соревнования (в формате .xlsx)</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="inlineRadio">Статус соревнования:</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radioOption" id="inlineRadio" value="1">
                                        <label class="form-check-label" for="inlineRadio">Включено</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radioOption" id="inlineRadio" value="0">
                                        <label class="form-check-label" for="inlineRadio">Выключено</label>
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
