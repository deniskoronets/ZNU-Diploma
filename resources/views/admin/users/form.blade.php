@extends('layouts.app')

@section('content')
    <h2>Пользователь</h2>
    <div class="row">
        <div class="col-md-6">
            {!! form($form) !!}
        </div>
    </div>
@endsection