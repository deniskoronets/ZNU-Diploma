@extends('layouts.app')

@section('content')

    <h1>Список разовых занятий</h1>
    <p>
        <a href="{{ route('lessons.single.createSingle') }}" class="btn btn-success">Добавить занятие</a>
        <a href="{{ route('lessons.single.singleToPdf') }}" class="btn btn-success">Экспорт в Excel</a>
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
                <td>Действия</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
            <tr>
                <td>{{ $lesson->date_of }}</td>
                <td>{{ $lesson->group->name }}</td>
                <td>{{ $lesson->lessonType->name }}</td>
                <td>{{ $lesson->discipline->name }}</td>
                <td>{{ $lesson->year }}</td>
                <td>{{ $lesson->semester }}</td>
                <td>
                    <a href="{{ route('lessons.single.update', ['id' => $lesson->id]) }}"><i class="fa fa-pencil"></i></a>&nbsp;
                    <a href="{{ route('lessons.single.delete', ['id' => $lesson->id]) }}"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection