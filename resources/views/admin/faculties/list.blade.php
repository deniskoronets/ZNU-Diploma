@extends('layouts.app')

@section('content')

    <h1>Список факультетов</h1>
    <p>
        <a href="{{ route('admin.faculties.create') }}" class="btn btn-success">Добавить факультет</a>
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Имя</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach ($faculties as $faculty)
            <tr>
                <td>{{ $faculty->name }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.users.update', ['id' => $faculty->id]) }}">Редактировать</a>
                    <a class="btn btn-danger">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection