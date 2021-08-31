<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
  protected $table = 'attendance_status';
  protected $fillable = ['attendance_id','subject_id','student_id','status','added_by','updated_by'];

  public function attendance_get_status()
  {
    return $this->belongsTo('App\Attendance','attendance_id');
  }

  public function attendance_status_get_student()
  {
    return $this->belongsTo('App\User','student_id');
  }
}
