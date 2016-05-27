@extends('layouts.app')

@section('content')
    <style>
        .admin-row .col-md-4 {
            padding: 20px;
            border: 1px solid #f2f2f2;
        }
    </style>
    <h2>Админцентр</h2>
    <div class="row admin-row">
        <div class="col-md-4">
            <a href="{{ route('admin.users.getList') }}">Пользователи</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.faculties.getList') }}">Факультеты</a>
        </div>
        <div class="col-md-4">
            <a href="#">Академические группы</a>
        </div>
    </div>
    <div class="row admin-row">
        <div class="col-md-4">
            <a href="#">Специальности</a>
        </div>
        <div class="col-md-4">
            <a href="#">Кафедры</a>
        </div>
        <div class="col-md-4">
            <a href="#">Типы занятий</a>
        </div>
    </div>
    <div class="row admin-row">
        <div class="col-md-4">
            <a href="#">Выходные</a>
        </div>
    </div>
@endsection