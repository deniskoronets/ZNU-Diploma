@extends('layouts.app')

@section('content')

    <h1>Список разовых занятий</h1>
    <p>
        <a href="{{ route('lessons.single.createSingle') }}" class="btn btn-success">Добавить занятие</a>
        <a href="{{ route('lessons.single.singleToPdf') }}" class="btn btn-success">Экспорт в PDF</a>
    </p>
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