<?php

namespace App\Http\Controllers;

use App\Models\LessonType;
use App\Models\PassesStudyLoad;
use App\Repositories\LessonsRepository;
use Illuminate\Http\Request;

class LoadController extends Controller {

	public function planned() {
		return view('load.planned');
	}

	public function passed(Request $request, LessonsRepository $lessonsRepository) {

		$dateFrom = '';
		$dateTo = '';
		$tableType = '';

		$dateFrom = $request->get('date_from', date('Y-m-d', strtotime('-1 week')));
		$dateTo = $request->get('date_to', date('Y-m-d'));
		$tableType = $request->get('tableType', 1);

		if ($request->has('date_from')) {
			$dateFrom = (new \DateTime($dateFrom))->format('Y-m-d');
			$dateTo = (new \DateTime($dateTo))->format('Y-m-d');
		}

		switch ($tableType) {

		case 1:

			$data = [];

			$load = PassesStudyLoad::whereBetween('date_at', [
				$dateFrom, $dateTo,
			])->where('user_id', \Auth::user()->id)->get();

			foreach ($load as $row) {
				$data[] = [
					'date' => $row->date_at,
					'lesson_type' => $row->lesson->lessonType->name,
					'group_name' => $row->lesson->group->name,
					'discipline' => $row->lesson->discipline->name,
					'hours_num' => $row->hours_num,
				];
			}
			break;

		case 2:
			$data = [
				'I семестр' => [
					'data' => [],
					'months' => [
						9 => [
							'month' => 'Вересень',
							'data' => [],
						],
						10 => [
							'month' => 'Жовтень',
							'data' => [],
						],
						11 => [
							'month' => 'Листопад',
							'data' => [],
						],
						12 => [
							'month' => 'Грудень',
							'data' => [],
						],
						1 => [
							'month' => 'Січень',
							'data' => [],
						],
					],
				],
				'II семестр' => [
					'data' => [],
					'months' => [
						2 => [
							'month' => 'Лютий',
							'data' => [],
						],
						3 => [
							'month' => 'Березень',
							'data' => [],
						],
						4 => [
							'month' => 'Квітень',
							'data' => [],
						],
						5 => [
							'month' => 'Травень',
							'data' => [],
						],
						6 => [
							'month' => 'Червень',
							'data' => [],
						],
						7 => [
							'month' => 'Липень',
							'data' => [],
						],
						8 => [
							'month' => 'Серпень',
							'data' => [],
						],
					],
				],
			];

			$load = PassesStudyLoad::whereBetween('date_at', [
				$dateFrom, $dateTo,
			])->where('user_id', \Auth::user()->id)->get();

			foreach ($load as $row) {
				$monthId = (int) (new \DateTime($row->date_at))->format('m');

				if (isset($data['I семестр']['months'][$monthId])) {
					$c = &$data['I семестр']['months'][$monthId];
				} else {
					$c = &$data['II семестр']['months'][$monthId];
				}

				if (!isset($c['data'][$row->lesson->lesson_type_id])) {
					$c['data'][$row->lesson->lesson_type_id] = 0;
				}

				$c['data'][$row->lesson->lesson_type_id] += $row->hours_num;
			}
			//dd($data);
			unset($c);

			foreach ($data as &$row) {
				foreach ($row['months'] as $monthId => $month) {
					foreach ($month['data'] as $key => $monthData) {
						@$row['months'][$monthId]['data'][-1] += $monthData;
						@$row['data'][$key] += $monthData;
						@$row['data'][-1] += $monthData;
					}
				}
			}
			break;

		case 3:
			$data = [];

			$load = PassesStudyLoad::whereBetween('date_at', [
				$dateFrom, $dateTo,
			])->where('user_id', \Auth::user()->id)->orderBy('date_at', 'desc')->get();

			$firstWeek = $load->first();

			$prevWeekNo = date('W', strtotime($firstWeek->date_at));
			$isNumerator = $lessonsRepository->checkIsNumerator($firstWeek->date_at);

			foreach ($load as $row) {

				$weekN = date('W', strtotime($row->date_at));

				if ($prevWeekNo != $weekN) {
					$isNumerator = !$isNumerator;
				}

				if (!isset($data[$weekN])) {
					$data[$weekN] = [
						'type' => $isNumerator,
						'data' => [],
					];
				}

				@$data[$weekN]['data'][$row->date_at][$row->lesson->lesson_type_id] += $row->hours_num;

				$prevWeekNo = $weekN;
			}

			break;
		}

		return view('load.passed', [
			'dateFrom' => $dateFrom,
			'dateTo' => $dateTo,
			'tableType' => $tableType,
			'data' => $data,
			'lessonTypes' => json_decode(json_encode(
				array_merge(LessonType::all()->toArray(), [-1 => ['id' => -1, 'name' => 'Всього']])
			)),
		]);
	}

	public function create() {
		return view('load.create');
	}
}
