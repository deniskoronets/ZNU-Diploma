<?php

namespace App\Console\Commands;

use App\Models\DatedLesson;
use App\Models\DateHolidays;
use App\Models\Lesson;
use App\Models\PassesStudyLoad;
use App\Repositories\LessonsRepository;
use Illuminate\Console\Command;

class DemoStudyLoadGenerator extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'demo_study';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(LessonsRepository $repository) {

		$year = date('Y');
		$isNumerator = true;

		PassesStudyLoad::truncate();

		foreach ([1, 2] as $semester) {

			foreach ($repository->getSemesterDates($semester) as $date) {

				if ($date->format('N') == 7) {
					$isNumerator = !$isNumerator;
					continue;
				}

				if (DateHolidays::where('date_at', $date->format('Y-m-d'))->exists()) {
					continue;
				}

				$lessons = Lesson::where('is_numerator', (int) $isNumerator)
					->where('semester', $semester)
					->where('year', date('Y'))
					->where('weekday', $date->format('N'))
					->get();

				$datedLessons = DatedLesson::where('date_of', 'LIKE', $date->format('Y-m-d') . '%')->get();

				foreach ($lessons as $lesson) {

					PassesStudyLoad::create([
						'user_id' => $lesson->user_id,
						'is_dated' => 0,
						'lesson_id' => $lesson->id,
						'date_at' => $date->format('Y-m-d'),
						'hours_num' => LessonsRepository::PAIR_HOURS,
					]);
				}

				foreach ($datedLessons as $lesson) {
					PassesStudyLoad::create([
						'user_id' => $lesson->user_id,
						'is_dated' => 1,
						'lesson_id' => $lesson->id,
						'date_at' => $date->format('Y-m-d'),
						'hours_num' => LessonsRepository::PAIR_HOURS,
					]);
				}
			}
		}
	}
}
