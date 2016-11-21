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
				<label>Дата и время проведения</label>
				<input type='text' name='date_of' class='form-control' value="{{ old('date_of', (new \DateTime($lesson->date_of))->format('Y-m-d H:i')) }}" placeholder="{{ date('Y-m-d H:i') }}">
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