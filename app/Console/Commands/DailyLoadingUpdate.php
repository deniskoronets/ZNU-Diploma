<?php

namespace App\Console\Commands;

use App\Models\Lesson;
use App\Models\PassesStudyLoad;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Repositories\LessonsRepository;

class DailyLoadingUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_loading';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(LessonsRepository $repository)
    {
        $typeOfWeek = $repository->getCurrentTypeOfWeek();
        $semester = $repository->getCurrentSemester();

        $currentDayLessons = Lesson::where([
            'weekday' => Carbon::today()->dayOfWeek,
            'is_numerator' => $typeOfWeek,
            'year' => Carbon::today()->year,
            'semester' => $semester,
        ])->get();

        foreach ($currentDayLessons as $lesson) {
            PassesStudyLoad::create([
                'user_id' => $lesson->user_id,
                'lesson_id' => $lesson->id,
                'is_dated' => 0,
                'date_at' => Carbon::now(),
                'hours_num' => 1.83,
            ]);
        }
    }
}
