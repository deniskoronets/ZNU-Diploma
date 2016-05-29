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
use PDF;

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

	public function toPdf()
	{

		\Storage::put(
			'tmpfile.xls',
			(string)view('lessons.pdf', [
				'daysOfWeek' => $this->lessons->getShortDaysOfWeek(),
				'lessons' => $this->lessons->getLessonsGrouppedByDaysOfWeek(
					Lesson::where('user_id', Auth::user()->id)
				),
			])
		);

		return response()->download(storage_path('app/tmpfile.xls'));
	}

    public function getList(Request $request)
    {
        $search = [
            'week_type' => 1,
            'year' => date('Y'),
            'semester' => 2,
        ];

        $validator = Validator::make($request->all(), [
            'search.week_type' => 'required|in:0,1,2',
            'search.year' => 'required|integer',
            'search.semester' => 'required|in:1,2',
        ]);

        if (!$validator->fails()) {
            $search = [
                'week_type' => $request->input('search.week_type'),
                'year' => $request->input('search.year'),
                'semester' => $request->input('search.semester'),
            ];
        }

        $lessonsCondition = Lesson::where('user_id', Auth::user()->id)
            ->where('year', $search['year'])
            ->where('semester', $search['semester'])
            ->where('is_numerator', $search['week_type'] == 1 ? 1 : 0);

    	return view('lessons.list', [
            'search' => $search,
    		'daysOfWeek' => $this->lessons->getShortDaysOfWeek(),
    		'lessons' => $this->lessons->getLessonsGrouppedByDaysOfWeek(
                $lessonsCondition
            ),
		]);
    }

    public function create(Request $request)
    {
        $lesson = new Lesson;

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
            'lesson' => $lesson,
    		'groups' => FacultyGroup::all(),
    		'lessonTypes' => LessonType::all(),
    		'disciplines' => Discipline::all(),
    		'weekDays' => $this->lessons->getFullDaysOfWeek(),
		]);
    }

    public function delete($id, Request $request)
    {
        return;
    }

    public function update($id, Request $request)
    {
        $lesson = Lesson::findOrFail($id);

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

            $this->lessons->update($id, $request);

            return redirect()->route('lessons.getList')->with('success', 'Занятие успешно отредактировано');
        }

        return view('lessons.create', [
            'lesson' => $lesson,
            'groups' => FacultyGroup::all(),
            'lessonTypes' => LessonType::all(),
            'disciplines' => Discipline::all(),
            'weekDays' => $this->lessons->getFullDaysOfWeek(),
        ]);
    }
}
