<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
  protected $table = 'subjects';
  protected $fillable = ['title','description','code','semester','lecture_hours_per_week','tutorial_hours_per_week','practical_hours_per_week','ss_hours_per_week','credits'];

  public function classroom_teachers_get_subjects()
  {
    return $this->hasMany('App\Classroom_Teachers','subject_id');
  }

  public function batch_teachers_get_subjects()
  {
    return $this->hasMany('App\Batch_Teachers','subject_id');
  }

  public function assignments_get_subjects()
  {
    return $this->hasMany('App\Assignments','subject_id');
  }

  public function attendance_get_subjects()
  {
    return $this->hasMany('App\Attendance','subject_id');
  }

  public function materials_get_subjects()
  {
    return $this->hasMany('App\StudyMaterial','subject_id');
  }
}
