<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom_Teachers extends Model
{
    protected $table = 'classroom_teachers';
  	protected $fillable = ['classroom_id','teacher_id','subject_id'];

    public function classroom_teachers_get_teachers()
    {
      return $this->belongsTo('App\User','teacher_id');
    }

    public function classroom_teachers_get_subjects()
    {
      return $this->belongsTo('App\Subjects','subject_id');
    }
}
