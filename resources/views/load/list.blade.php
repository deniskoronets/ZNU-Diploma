@extends('layouts.app')

@section('content')
    <h1>Нагрузка</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#plan">Запланированная</a></li>
        <li><a data-toggle="tab" href="#passed">Выполненная</a></li>
    </ul>

    <div class="tab-content">
        <div id="plan" class="tab-pane fade in active">
            <h3>Запланированная нагрузка</h3>
            <p>
                <a class='btn btn-success' href='{{ route('load.create') }}'>Добавить нагрузку</a>
            </p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Занятие</td>
                        <td>Количество часов</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ПН: 10:00 основы програмной инженерии</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="passed" class="tab-pane fade">
            <h3>Выполненая нагрузка</h3>
            <form action="" method="post">
                <div class="form-group col-md-4">
                    <label>Дата от</label>
                    <input type="text" name="date_from" value="10.06.2016" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Дата до</label>
                    <input type="text" name="date_to" value="16.06.2016" class="form-control">
                </div>
                <div class="col-md-4" style="margin-top: 25px;">
                    <input type="submit" class="btn btn-success" value="Найти">
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Лекции</td>
                        <td>Лабораторные</td>
                        <td>Конспекты</td>
                        <td>Зачеты</td>
                        <td>Экз конспекты</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="4">Числитель</td>
                        <td>10.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>11.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>12.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>13.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td rowspan="4">Знаменатель</td>
                        <td>10.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>11.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>12.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>13.06.2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection