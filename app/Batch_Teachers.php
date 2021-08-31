<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch_Teachers extends Model
{
   	protected $table = 'batch_teachers';
   	protected $fillable = ['teacher_id','subject_id','batch_id'];

    public function batch_teachers_get_teachers()
    {
      return $this->belongsTo('App\User','teacher_id');
    }

    public function batch_teachers_get_subjects()
    {
      return $this->belongsTo('App\Subjects','subject_id');
    }
}
