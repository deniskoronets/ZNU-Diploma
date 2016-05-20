<form action='' method='post'>
	<div class='row'>
		<div class='col-md-6 col-md-offset-3'>
			{{ csrf_field() }}
			<div class='form-group'>
				<label>Группа</label>
				<select name='faculty_group' class='form-control'>
					@foreach ($groups as $group)
					<option value='{{ $group->id }}'>{{ $group->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>Тип занятия</label>
				<select name='lesson_type' class='form-control'>
					@foreach ($lessonTypes as $lessonType)
					<option value='{{ $lessonType->id }}'>{{ $lessonType->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>Дисциплина</label>
				<select name='discipline' class='form-control'>
					@foreach ($disciplines as $discipline)
					<option value='{{ $discipline->id }}'>{{ $discipline->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>День недели</label>
				<select name='day_of_week' class='form-control'>
					@foreach ($weekDays as $weekDayId => $weekDay)
					<option value='{{ $weekDayId }}'>{{ $weekDay }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group checkbox'>
				<label><input type='checkbox' name='weekType[1]'> Числитель</label>
				<label><input type='checkbox' name='weekType[2]'> Знаменатель</label>
			</div>
			<div class='form-group'>
				<label>Время начала</label>
				<input type='text' name='time_start' class='form-control'>
			</div>
			<div class='form-group'>
				<label>Учебный год</label>
				<input type='text' name='year' class='form-control' value='{{ date('Y') }}'>
			</div>
			<div class='form-group'>
				<label>Семестр</label>
				<select name='semester' class='form-control'>
					<option value='1'>I</option>
					<option value='2'>II</option>
				</select>
			</div>

			<input type='submit' class='btn btn-success' value='Сохранить'>
		</div>
	</div>
</form>