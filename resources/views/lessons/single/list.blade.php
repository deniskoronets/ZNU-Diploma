@extends('layouts.app')

@section('content')

    <h1>Список разовых занятий</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Дата</td>
                <td>Группа</td>
                <td>Тип занятия</td>
                <td>Дисциплина</td>
                <td>Год</td>
                <td>Семестр</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
            <tr>
                <td>{{ $lesson->date_of }}</td>
                <td>{{ $lesson->group->name }}</td>
                <td>{{ $lesson->type->name }}</td>
                <td>{{ $lesson->discipline->name }}</td>
                <td>{{ $lesson->year }}</td>
                <td>{{ $lesson->semester }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection