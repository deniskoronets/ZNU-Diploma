<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Lesson;
use App\Models\FacultyGroup;
use App\Models\LessonType;
use App\Models\Discipline;
use App\Repositories\LessonsRepository;
use Auth;
use Validator;

class LessonsController extends Controller
{
	private $lessons;

	public function __construct(LessonsRepository $lessonsRepository)
	{
		$this->lessons = $lessonsRepository;
	}

	public function createSingle()
	{
		return '';
	}

	public function getSingleList()
	{
		return view('lessons.single.list', [
			'lessons' => $this->lessons->getSingleLessonsByUserId(Auth::user()->id),
		]);
	}
	
	public function singleToPdf()
	{
		return '';
	}

    public function getList()
    {
    	return view('lessons.list', [
    		'daysOfWeek' => $this->lessons->getShortDaysOfWeek(),
    		'lessons' => $this->lessons->getLessonsGrouppedByDaysOfWeek(
                Lesson::where('user_id', Auth::user()->id)
            ),
		]);
    }

    public function create(Request $request)
    {
    	if ($request->method() == 'POST') {

            $validator = Validator::make($request->all(), [
                'faculty_group' => 'required',
                'lesson_type' => 'required',
                'discipline' => 'required',
                'day_of_week' => 'required|between:1,7',
                'time_start' => 'required|date_format:H:i',
                'year' => 'required|numeric',
                'semester' => 'required|between:1,2',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            $this->lessons->create($request);

    		return redirect()->route('lessons.getList')->with('success', 'Занятие успешно добавлено');
    	}

    	return view('lessons.create', [
    		'groups' => FacultyGroup::all(),
    		'lessonTypes' => LessonType::all(),
    		'disciplines' => Discipline::all(),
    		'weekDays' => $this->lessons->getFullDaysOfWeek(),
		]);
    }
}
