<form action='' method='post'>
	<div class='row'>
		<div class='col-md-6 col-md-offset-3'>
			{{ csrf_field() }}
			<div class='form-group'>
				<label>Группа</label>
				<select name='faculty_group' class='form-control'>
					@foreach ($groups as $group)
					<option value='{{ $group->id }}'
						@if (old('faculty_group', $lesson->group_id) == $group->id) SELECTED @endif
					>{{ $group->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>Тип занятия</label>
				<select name='lesson_type' class='form-control'>
					@foreach ($lessonTypes as $lessonType)
					<option value='{{ $lessonType->id }}'
						@if (old('lesson_type', $lesson->lesson_type_id) == $lessonType->id) SELECTED @endif
					>{{ $lessonType->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>Дисциплина</label>
				<select name='discipline' class='form-control'>
					@foreach ($disciplines as $discipline)
					<option value='{{ $discipline->id }}'
						@if (old('discipline', $lesson->discipline_id) == $lessonType->id) SELECTED @endif
					>{{ $discipline->name }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label>День недели</label>
				<select name='day_of_week' class='form-control'>
					@foreach ($weekDays as $weekDayId => $weekDay)
					<option value='{{ $weekDayId }}'
						@if (old('day_of_week', $lesson->week_day) == $weekDayId) SELECTED @endif
					>{{ $weekDay }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group checkbox'>
				<label><input type='checkbox' name='weekType[1]'
			  		@if (old('weekType[1]', $lesson->is_numerator ? 1 : null)) CHECKED @endif
				> Числитель</label>
				<label><input type='checkbox' name='weekType[2]'
				  	@if (old('weekType[2]', $lesson->is_numerator ? null : 1)) CHECKED @endif
				> Знаменатель</label>
			</div>
			<div class='form-group'>
				<label>Время начала</label>
				<input type='text' name='time_start' class='form-control' value="{{ old('time_start', $lesson->time_start) }}">
			</div>
			<div class='form-group'>
				<label>Учебный год</label>
				<input type='text' name='year' class='form-control' value="{{ old('year', $lesson->year) ?: '2016' }}">
			</div>
			<div class='form-group'>
				<label>Семестр</label>
				<select name='semester' class='form-control'>
					<option value='1' @if (old('semester', $lesson->semester) == 1) SELECTED @endif>I</option>
					<option value='2' @if (old('semester', $lesson->semester) == 2) SELECTED @endif>II</option>
				</select>
			</div>

			<input type='submit' class='btn btn-success' value='Сохранить'>
		</div>
	</div>
</form>