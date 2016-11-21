<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatedLesson extends Model {
	protected $table = 'dated_lessons';
	public $timestamps = false;
	protected $fillable = [
		'user_id', 'faculty_id', 'group_id',
		'lesson_type_id', 'discipline_id',
		'year', 'semester', 'date_of',
	];

	public function discipline() {
		return $this->belongsTo(Discipline::class, 'discipline_id', 'id');
	}

	public function faculty() {
		return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
	}

	public function group() {
		return $this->belongsTo(FacultyGroup::class, 'group_id', 'id');
	}

	public function lessonType() {
		return $this->belongsTo(LessonType::class, 'lesson_type_id', 'id');
	}
}
