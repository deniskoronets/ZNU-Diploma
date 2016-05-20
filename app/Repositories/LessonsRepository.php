<?php

namespace App\Repositories;

use App\Models\DatedLesson;
use App\Models\FacultyGroup;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsRepository
{
	public function getSingleLessonsByUserId($userId)
	{
		return DatedLesson::where('user_id', $userId)->get();
	}

	public function getFullDaysOfWeek()
	{
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

	public function getShortDaysOfWeek()
	{
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

	public function getLessonsGrouppedByDaysOfWeek(Builder $builder = null)
	{
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

    public function create(Request $request)
    {
        $facultyGroup = FacultyGroup::findOrFail($request->input('faculty_group'));

        Lesson::create([
            'user_id' => Auth::user()->id,
            'faculty_id' => $facultyGroup->faculty_id,
            'group_id' => $request->input('faculty_group'),
            'lesson_type_id' => $request->input('lesson_type'),
            'discipline_id' => $request->input('discipline'),
            'weekday' => $request->input('day_of_week'),
            'is_numerator' => 1,
            'time_start' => $request->input('time_start'),
            'year' => $request->input('year'),
            'semester' => $request->input('semester'),
        ]);
    }
}