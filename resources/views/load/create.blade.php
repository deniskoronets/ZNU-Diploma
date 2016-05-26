@extends('layouts.app')

@section('content')
    <h1>Нагрузка</h1>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label>Занятие</label>
                <select name="lesson" class="form-control">
                    <option value="0">ПН: основы программной инженерии</option>
                </select>
            </div>
            <div class="form-group">
                <label>Количество часов</label>
                <input type="text" class="form-control">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>
        </div>
    </div>

@endsection