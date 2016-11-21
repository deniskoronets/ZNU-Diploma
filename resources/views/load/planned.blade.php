@extends('layouts.app')

@section('content')
    <h1>Нагрузка</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a href="{{ route('load.planned') }}">Запланированная</a></li>
        <li><a href="{{ route('load.passed') }}">Выполненная</a></li>
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
                    	<td>Год</td>
                    	<td>Семестр</td>
                        <td>Занятие</td>
                        <td>Количество часов</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    	<td>2016</td>
                    	<td>I</td>
                        <td>Понеділок, 12:55 - Професійна практика ПІ</td>
                        <td>38</td>
                    </tr>
                    <tr>
                    	<td>2016</td>
                    	<td>I</td>
                        <td>Понеділок, 16:05 - Управління автоматизованими комп. системами</td>
                        <td>30</td>
                    </tr>
                    <tr>
                    	<td>2016</td>
                    	<td>I</td>
                        <td>Середа, 12:55 - Геоінформаційні системи в екології</td>
                        <td>26</td>
                    </tr>
                    <tr>
                    	<td>2016</td>
                    	<td>I</td>
                        <td>Середа, 14:30 - Адміністрування комп’ютерних систем</td>
                        <td>26</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection