<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $table = 'assignments';
   	protected $fillable = ['title','description','attachments','start_date_and_time','end_date_and_time','maximum_marks','more_details','allow_deadline_submission','teacher_id','subject_id','classroom_id','batch_id'];


    public function assignments_get_classrooms()
    {
      return $this->belongsTo('App\Classrooms','classroom_id');
    }

    public function assignments_get_teachers()
    {
      return $this->belongsTo('App\User','teacher_id');
    }

    public function assignments_get_batches()
    {
      return $this->belongsTo('App\Batches','batch_id');
    }

    public function assignments_get_subjects()
    {
      return $this->belongsTo('App\Subjects','subject_id');
    }

    public function assignments_get_submissions()
    {
      return $this->hasMany('App\Assignment_Submissions','assignment_id','id');
    }
}
