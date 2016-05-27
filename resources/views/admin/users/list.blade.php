@extends('layouts.app')

@section('content')

    <h1>Список пользователей</h1>
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Добавить пользователя</a>
    </p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Имя</td>
            <td>Email</td>
            <td>Кафедра</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->department_id }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.users.update', ['id' => $user->id]) }}">Редактировать</a>
                    <a class="btn btn-danger">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection