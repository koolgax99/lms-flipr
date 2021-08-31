<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
  protected $table = 'classrooms';
  protected $fillable = ['title','description','department_id','class_teacher_id','start_date','end_date'];

  public function classrooms_get_students()
  {
    return $this->hasMany('App\User','classroom_id');
  }

  public function assignments_get_classrooms()
  {
    return $this->hasMany('App\Assignments','classroom_id');
  }

  public function attendance_get_classrooms()
  {
    return $this->hasMany('App\Attendance','classroom_id');
  }

  public function materials_get_classrooms()
  {
    return $this->hasMany('App\StudyMaterial','classroom_id');
  }
}
