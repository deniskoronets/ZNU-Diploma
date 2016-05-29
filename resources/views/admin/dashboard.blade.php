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
            <a href="{{ route('admin.users.getList') }}"><i class="fa fa-users"></i> Пользователи</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.faculties.getList') }}"><i class="fa fa-university"></i> Факультеты</a>
        </div>
        <div class="col-md-4">
            <a href="#"><i class="fa fa-user-plus"></i> Академические группы</a>
        </div>
    </div>
    <div class="row admin-row">
        <div class="col-md-4">
            <a href="#"><i class="fa fa-graduation-cap"></i>  Специальности</a>
        </div>
        <div class="col-md-4">
            <a href="#"><i class="fa fa-street-view"></i> Кафедры</a>
        </div>
        <div class="col-md-4">
            <a href="#"><i class="fa fa-file"></i> Типы занятий</a>
        </div>
    </div>
    <div class="row admin-row">
        <div class="col-md-4">
            <a href="#"><i class="fa fa-calendar"></i> Выходные</a>
        </div>
    </div>
@endsection