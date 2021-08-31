<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom_Timetable extends Model
{
    protected $table = 'classroom_timetable';
    protected $fillable = ['title','department_id','classroom_id','batch_id','subject_d','semester_start_date','semester_end_date','lecture_start_time','lecture_end_time','day_of_the_week'];
    
    public function classroom_timetable_get_subjects()
  {
    return $this->belongsTo('App\Subjects','subject_id');
  }
}

