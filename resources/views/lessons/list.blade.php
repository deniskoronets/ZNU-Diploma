@extends('layouts.app')

@section('content')
<h1>Расписание занятий</h1>

<p>
	<a class='btn btn-success' href='{{ route('lessons.create') }}'>Добавить занятие</a>
	<a class='btn btn-success' href='{{ route('lessons.toPdf') }}'>Экспорт в Excel</a>
</p>
<hr>
<form action="" method="get">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Тип недели</label>
                <select name="search[week_type]" class="form-control">
                    @foreach ([0 => 'Все', 1 => 'Числитель', 2 => 'Знаменатель'] as $k => $v)
                    <option value="{{ $k }}"
                        @if ($search['week_type'] == $k) selected @endif
                    >{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Учебный год</label>
                <select name="search[year]" class="form-control">
                    @foreach (range(date('Y') - 5, date('Y') + 5) as $year)
                        <option @if ($search['year'] == $year)) selected @endif >{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Семестр</label>
                <select name="search[semester]" class="form-control">
                    <option value="1" @if ($search['semester'] == 1) selected @endif >I</option>
                    <option value="2" @if ($search['semester'] == 2) selected @endif >II</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-default" value="Найти">
        </div>
    </div>
</form>

<div style="height: 30px;"></div>

<table class='table'>
    @foreach ($daysOfWeek as $dayId => $dayText)
    <tr>
    	<td class='weekDayName' style='font-size: 35px; width: 50px;'>{{ $dayText }}</td>
    	<td>
    		@if (empty($lessons[$dayId]))
    			<i>ДСР</i>
			@endif

    		<table class='table table-bordered'>
    			<colgroup>
    				<col style='width: 10%;'>
    				<col style='width: 70%;'>
    				<col style='width: 30%:'>
    			</colgroup>
    			@foreach ($lessons[$dayId] as $lesson)
    			<tr>
    				<td>{{ $lesson->time_start }}</td>
    				<td>
    					<b>{{ $lesson->discipline->name }}</b><br>
    					{{ $lesson->is_numerator ? 'числитель' : 'знаменатель' }}
    				</td>
    				<td>
    					<b>{{ $lesson->faculty->name }}</b><br>
    					группа {{ $lesson->group->name }}
					</td>
                    <td>
                        <a href="{{ route('lessons.update', ['id' => $lesson->id]) }}"><i class="fa fa-pencil"></i></a>&nbsp;
                        <a href="{{ route('lessons.delete', ['id' => $lesson->id]) }}"><i class="fa fa-trash-o"></i></a>
                    </td>
    			</tr>
    			@endforeach
			</table>
    	</td>
	</tr>
    @endforeach
</table>
@endsection
