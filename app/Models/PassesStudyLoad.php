<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassesStudyLoad extends Model {
	protected $table = 'passes_study_loads';
	public $timestamps = false;
	protected $fillable = [
		'user_id', 'is_dated', 'lesson_id', 'date_at', 'hours_num',
	];

	public function lesson() {
		if (!$this->is_dated) {
			return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
		}

		return $this->belongsTo(DatedLesson::class, 'lesson_id', 'id');
	}
}
