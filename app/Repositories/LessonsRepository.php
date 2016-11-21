<?php

namespace App\Repositories;

use App\Models\DatedLesson;
use App\Models\FacultyGroup;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsRepository {
	public function getSingleLessonsByUserId($userId) {
		return DatedLesson::where('user_id', $userId)->get();
	}

	public function getFullDaysOfWeek() {
		return [
			1 => 'Понедельник',
			2 => 'Вторник',
			3 => 'Среда',
			4 => 'Четверг',
			5 => 'Пятница',
			6 => 'Суббота',
			7 => 'Воскресенье',
		];
	}

	public function getShortDaysOfWeek() {
		return [
			1 => 'Пн',
			2 => 'Вт',
			3 => 'Ср',
			4 => 'Чт',
			5 => 'Пт',
			6 => 'Сб',
			7 => 'Вс',
		];
	}

	public function getLessonsGrouppedByDaysOfWeek(Builder $builder = null) {
		$lessons = [
			1 => [],
			2 => [],
			3 => [],
			4 => [],
			5 => [],
			6 => [],
			7 => [],
		];

		$query = $builder->orderBy('time_start', 'ASC')->get();

		foreach ($query as $lesson) {
			$lessons[$lesson->weekday][] = $lesson;
		}

		return $lessons;
	}

	public function update($id, Request $request) {
		$facultyGroup = FacultyGroup::findOrFail($request->input('faculty_group'));

		$lesson = Lesson::findOrFail($id);

		$lesson->update([
			'user_id' => Auth::user()->id,
			'faculty_id' => $facultyGroup->faculty_id,
			'group_id' => $request->input('faculty_group'),
			'lesson_type_id' => $request->input('lesson_type'),
			'discipline_id' => $request->input('discipline'),
			'weekday' => $request->input('day_of_week'),
			'is_numerator' => $request->has('weekType[1]'),
			'time_start' => $request->input('time_start'),
			'year' => $request->input('year'),
			'semester' => $request->input('semester'),
		]);
	}

	public function updateSingle($id, Request $request) {
		$facultyGroup = FacultyGroup::findOrFail($request->input('faculty_group'));

		$lesson = DatedLesson::findOrFail($id);

		$lesson->update([
			'user_id' => Auth::user()->id,
			'faculty_id' => $facultyGroup->faculty_id,
			'group_id' => $request->input('faculty_group'),
			'lesson_type_id' => $request->input('lesson_type'),
			'discipline_id' => $request->input('discipline'),
			'year' => $request->input('year'),
			'semester' => $request->input('semester'),
			'date_of' => $request->input('date_of'),
		]);
	}

	public function create(Request $request) {
		$facultyGroup = FacultyGroup::findOrFail($request->input('faculty_group'));

		$isNumerator = [];

		if (!$request->has('weekType[1]') && $request->has('weekType[2]')) {
			about(400, 'Не указан тип недели');
		}

		if ($request->has('weekType[1]')) {
			$isNumerator[] = 1;
		}

		if ($request->has('weekType[2]')) {
			$isNumerator[] = 0;
		}

		foreach ($isNumerator as $weekFlag) {
			Lesson::create([
				'user_id' => Auth::user()->id,
				'faculty_id' => $facultyGroup->faculty_id,
				'group_id' => $request->input('faculty_group'),
				'lesson_type_id' => $request->input('lesson_type'),
				'discipline_id' => $request->input('discipline'),
				'weekday' => $request->input('day_of_week'),
				'is_numerator' => $weekFlag,
				'time_start' => $request->input('time_start'),
				'year' => $request->input('year'),
				'semester' => $request->input('semester'),
			]);
		}
	}

	public function createSingle(Request $request) {
		$facultyGroup = FacultyGroup::findOrFail($request->input('faculty_group'));

		DatedLesson::create([
			'user_id' => Auth::user()->id,
			'faculty_id' => $facultyGroup->faculty_id,
			'group_id' => $request->input('faculty_group'),
			'lesson_type_id' => $request->input('lesson_type'),
			'discipline_id' => $request->input('discipline'),
			'year' => $request->input('year'),
			'semester' => $request->input('semester'),
			'date_of' => $request->input('date_of'),
		]);
	}

	private $startSemesterDay = [
		1 => '1.09',
		2 => '1.02',
	];

	private $endSemesterDay = [
		1 => '31.01',
		2 => '31.08',
	];

	const PAIR_HOURS = 2;

	public function getSemesterDates($semester) {

		if (!in_array($semester, array_keys($this->startSemesterDay))) {
			return [];
		}

		$startDate = new \DateTime($this->startSemesterDay[$semester] . '.' . ($semester == 1 ? (date('Y') - 1) : date('Y')));
		$endDate = new \DateTime($this->endSemesterDay[$semester] . '.' . date('Y'));

		while ($startDate->format('N') != 1) {
			$startDate->add(new \DateInterval('P1D'));
		}

		while ($endDate->format('N') != 5) {
			$endDate->sub(new \DateInterval('P1D'));
		}

		$endDate->modify('+1 day');

		return new \DatePeriod(
			$startDate,
			new \DateInterval('P1D'),
			$endDate
		);
	}

	public function checkIsNumerator($date) {

		if (in_array(date('m', strtotime($date)), [9, 10, 11, 12, 1])) {
			$semester = 1;
		} else {
			$semester = 2;
		}

		$startDate = new \DateTime($this->startSemesterDay[$semester] . '.' . ($semester == 1 ? (date('Y') - 1) : date('Y')));

		while ($startDate->format('N') != 1) {
			$startDate->add(new \DateInterval('P1D'));
		}

		$startWeekNo = (int) $startDate->format('W');

		return date('W', strtotime($date)) - $startWeekNo % 2;
	}

	public function getCurrentTypeOfWeek() {
		return $this->checkIsNumerator(date('Y-m-d')) ? 1 : 2;
	}

	public function getCurrentSemester() {
		return 1;
	}
}