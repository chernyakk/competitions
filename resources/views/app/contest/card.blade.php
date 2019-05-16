@extends('layouts.app')

@section('content')
    <table class="table table-bordered table-striped myclass">
        <thead>
        <tr>
            {{--            Вот тут сразу в "<th>" надо вставить ФИО из таблицы--}}
            <th rowspan="2" scope="col"> <h4> Иванов <br> Иван Иванович </h4> </th>
            <th rowspan="2" scope="col">Сектор</th>
            <th rowspan="2" scope="col">Соперник</th>
            <th colspan="2" scope="col">Поимки</th>
            <th rowspan="2" scope="col">Результат (баллов):</th>
        </tr>
        <tr>
            <th>Личные</th>
            <th>Соперника</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Тур 1</th>
            <td>2</td>
            <td>Васильев Василий Васильевич</td>
            <td> 3 <a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td> 3 <a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td>1,5</td>
        </tr>
        <tr>
            <th scope="row">Тур 2</th>
            <td>25</td>
            <td>Алексеев Алексей Алексеевич</td>
            <td> 3 <a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td> 4 <a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td>0,5</td>
        </tr>
        <tr>
            <th scope="row">Тур 3</th>
            <td>33</td>
            <td>Константинов Константин Константинович</td>
            <td>4<a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td>3<a href="#" title="Изменить" aria-label="Редактировать">
                    <span class="fas fa-edit"></span>
                </a> </td>
            <td>3</td>
        </tr>
        </tbody>
    </table>
@endsection
