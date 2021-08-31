<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $table = 'attendance';
  protected $fillable = ['classroom_id','batch_id','subject_id','date','teacher_id','added_by','updated_by'];

  public function attendance_get_status()
  {
    return $this->hasMany('App\AttendanceStatus','attendance_id','id');
  }

  public function attendance_get_subjects()
  {
    return $this->belongsTo('App\Subjects','subject_id');
  }
  public function attendance_get_classrooms()
  {
    return $this->belongsTo('App\Classrooms','classroom_id');
  }
  public function attendance_get_batches()
  {
    return $this->belongsTo('App\Batches','batch_id');
  }
  public function attendance_get_teachers()
  {
    return $this->belongsTo('App\User','teacher_id');
  }
}
