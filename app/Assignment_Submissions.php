<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment_Submissions extends Model
{
    protected $table = 'assignment_submissions';
   	protected $fillable = ['title','answers','attachments','assignment_id','student_id','obtained_marks','comments'];

    public function assignments_get_submissions()
    {
      return $this->belongsTo('App\Assignments','assignment_id');
    }
    public function assignment_submissions_students()
    {
      return $this->belongsTo('App\User','student_id');
    }
}
