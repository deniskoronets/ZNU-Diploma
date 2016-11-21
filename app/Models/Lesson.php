<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {
	protected $table = 'lessons';
	public $timestamps = false;
	protected $fillable = [
		'user_id', 'faculty_id', 'group_id',
		'lesson_type_id', 'discipline_id',
		'weekday', 'is_numerator', 'time_start',
		'year', 'semester',
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
