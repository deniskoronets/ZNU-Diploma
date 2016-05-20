@extends('layouts.app')

@section('content')
<h1>Расписание занятий</h1>

<a class='btn btn-success' href='{{ route('lessons.create') }}'>Добавить занятие</a>

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
    			</tr>
    			@endforeach
			</table>
    	</td>
	</tr>
    @endforeach
</table>
@endsection
